<?PHP

require_once('Vector.class.php');

class Matrix {
    static public $verbose = FALSE;

    const IDENTITY = 'IDENTITY';
    const SCALE = 'SCALE';
    const RX = 'Ox ROTATION';
    const RY = 'Oy ROTATION';
    const RZ = 'Oz ROTATION';
    const TRANSLATION = 'TRANSLATION';
    const PROJECTION = 'PROJECTION';

    private $_vtxX;
    private $_vtxY;
    private $_vtxZ;
    private $_vtx0;
    private $_vtcX;
    private $_vtcY;
    private $_vtcZ;
    private $_vtc0;
    static private $_cc = NULL;

    public function __construct(array $kwargs) {
        if (array_key_exists('preset', $kwargs) == FALSE)
            return;
        if ($kwargs['preset'] == self::IDENTITY)
        {
            $this->_vtx0 = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
            $this->_vtxX = new Vertex( array( 'x' => 1.0, 'y' => 0.0, 'z' => 0.0 ) );
            $this->_vtxY = new Vertex( array( 'x' => 0.0, 'y' => 1.0, 'z' => 0.0 ) );
            $this->_vtxZ = new Vertex( array( 'x' => 0.0, 'y' => 0.0, 'z' => 1.0 ) );

            $this->_vtcX = new Vector( array( 'orig' => $this->_vtx0, 'dest' => $this->_vtxX ) );
            $this->_vtcY = new Vector( array( 'orig' => $this->_vtx0, 'dest' => $this->_vtxY ) );
            $this->_vtcZ = new Vector( array( 'orig' => $this->_vtx0, 'dest' => $this->_vtxZ ) );
            $this->_vtc0 = new Vector( array( 'orig' => $this->_vtx0, 'dest' => $this->_vtx0 ) );
        }
        elseif ($kwargs['preset'] == 'SCALE' && array_key_exists('scale', $kwargs))
        {
            
        }
        elseif ($kwargs['preset'] == 'RX' && array_key_exists('angle', $kwargs))
        {
            
        }
        elseif ($kwargs['preset'] == 'RY' && array_key_exists('angle', $kwargs))
        {
            
        }
        elseif ($kwargs['preset'] == 'RZ' && array_key_exists('angle', $kwargs))
        {
            
        }
        elseif ($kwargs['preset'] == 'TRANSLATION' && array_key_exists('vtc', $kwargs))
        {
            
        }
        elseif ($kwargs['preset'] == 'PROJECTION' 
                && array_key_exists('fov', $kwargs)
                && array_key_exists('ratio', $kwargs)
                && array_key_exists('near', $kwargs)
                && array_key_exists('far', $kwargs))
        {
 
        }
        else
            return;
        $this->_cc = $kwargs['preset'];
        if (self::$verbose === TRUE && self::$_cc)
            printf("Matrix " . self::$_cc . " instance constructed" . PHP_EOL );
        return;
    }

    public function __toString() {
        if (self::$verbose)
        {
            return (sprintf("M | vtcX | vtcY | vtcZ | vtc0" . PHP_EOL 
                          . "-----------------------------" . PHP_EOL  
                          . "x | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL
                          . "y | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL
                          . "z | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL
                          . "w | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL, 
                          $this->_vtcX->getX($this->_vtcX), $this->_vtcY->getX($this->_vtcY), $this->_vtcZ->getX($this->_vtcZ), $this->_vtc0->getX($this->_vtc0),
                          $this->_vtcX->getY($this->_vtcX), $this->_vtcY->getY($this->_vtcY), $this->_vtcZ->getY($this->_vtcZ), $this->_vtc0->getY($this->_vtc0),
                          $this->_vtcX->getZ($this->_vtcX), $this->_vtcY->getZ($this->_vtcY), $this->_vtcZ->getZ($this->_vtcZ), $this->_vtc0->getZ($this->_vtc0),
                          $this->_vtcX->getW($this->_vtcX), $this->_vtcY->getW($this->_vtcY), $this->_vtcZ->getW($this->_vtcZ), $this->_vtc0->getW($this->_vtc0)));
        }
    }

    public static function doc() {
        return (file_get_contents('Matrix.doc.txt') . PHP_EOL );
    }

    public function __destruct() {
        if (self::$verbose === TRUE && self::$_cc)
            printf("Matrix " . self::$_cc . " instance deconstructed" . PHP_EOL );
    }
}
?>