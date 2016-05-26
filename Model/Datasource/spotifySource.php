<?php 
App::uses('HttpSocket', 'Network/Http');

class SpotifySource extends DataSource {

/**
 * An optional description of your datasource
 */
    public $description = 'Spotify API';

/**
 * Our default config options. These options will be customized in our
 * ``app/Config/database.php`` and will be merged in the ``__construct()``.
 */
    public $config = array(
        'apiKey' => '',
        'clientID' => ''
    );

/**
 * Create our HttpSocket and handle any config tweaks.
 */
    public function __construct($config) {
        parent::__construct($config);
        $this->Http = new HttpSocket();
    }

/**
 * Since datasources normally connect to a database there are a few things
 * we must change to get them to work without a database.
 */

/**
 * listSources() is for caching. You'll likely want to implement caching in
 * your own way with a custom datasource. So just ``return null``.
 */
    public function listSources($data = null) {
        return null;
    }

/**
 * describe() tells the model your schema for ``Model::save()``.
 *
 * You may want a different schema for each model but still use a single
 * datasource. If this is your case then set a ``schema`` property on your
 * models and simply return ``$model->schema`` here instead.
 */
    public function describe($model) {
        return $this->_schema;
    }

/**
 * calculate() is for determining how we will count the records and is
 * required to get ``update()`` and ``delete()`` to work.
 *
 * We don't count the records here but return a string to be passed to
 * ``read()`` which will do the actual counting. The easiest way is to just
 * return the string 'COUNT' and check for it in ``read()`` where
 * ``$data['fields'] === 'COUNT'``.
 */
    public function calculate(Model $model, $func, $params = array()) {
        return 'COUNT';
    }

/**
 * Implement the R in CRUD. Calls to ``Model::find()`` arrive here.
 */
    public function read(Model $model, $queryData = array(), $recursive = null) {
        if ($queryData['fields'] === 'COUNT') {
            return array(array(array('count' => 1)));
        }

        /**
         * Now we get, decode and return the remote data.
         */
        
        $types = $queryData['conditions']['types'];
        unset($queryData['conditions']['types']);

        $res = '';
        $result = array(
            'albums' => array(), 
            'artists' => array(), 
            'tracks' => array()
        );

        if(strlen($types) <= 3 && preg_match('/[1-3]{1}/',$types)) {
            $tmp = array();
            $queryData['conditions']['apiKey'] = $this->config['apiKey'];

            if(preg_match('/[1]{1}/',$types)) {
                $tmp[] = 'album';
            }
            if(preg_match('/[2]{1}/',$types)) {
                $tmp[] = 'artist';
            }
            if(preg_match('/[3]{1}/',$types)) {
                $tmp[] = 'track';
            }

            foreach ($tmp as $key => $val) {
                $queryData['conditions']['type'] = $val;

                $json = $this->Http->get(
                    'https://api.spotify.com/v1/search',
                    $queryData['conditions']
                );

                $res = json_decode($json, true);

                foreach ($res['' . $val . 's']['items'] as $value) {
                    $albumUrl = $value['external_urls']['spotify'];

                    if($val == 'album') {
                        if(isset($value['images'][1]['url'])) {
                            $albumImage = $value['images'][1]['url'];
                        }else {
                            $albumImage = '';
                        }
                        $result['albums'][] = array('image' => $albumImage, 'url' => $albumUrl);
                    }else if($val == 'artist') {
                        if(isset($value['images'][1]['url'])) {
                            $albumImage = $value['images'][1]['url'];
                        }else {
                            $albumImage = '';
                        }
                        $result['artists'][] = array('image' => $albumImage, 'url' => $albumUrl);
                    }else if($val == 'track') {
                        if(isset($value['album']['images'][1]['url'])) {
                            $albumImage = $value['album']['images'][1]['url'];
                        }else {
                            $albumImage = '';
                        }
                        $result['tracks'][] = array('image' => $albumImage, 'url' => $albumUrl);
                    }
                }
            }
        }

        if (is_null($res)) {
            $error = json_last_error();
            throw new CakeException($error);
        }
        return array($model->alias => $result);
    }

}
?>