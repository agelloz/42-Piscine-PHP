<?PHP

require_once('Color.class.php');
require_once('Vertex.class.php');

class   Vector {
    private $_x;
    private $_y;
    private $_z;
    private $_w = 0.0;
    static $verbose = FALSE;

    public function __construct(array $kwargs) {
        if (array_key_exists('dest', $kwargs) && $kwargs['dest'] instanceof Vertex)
        {
            if (array_key_exists('orig', $kwargs) && $kwargs['orig'] instanceof Vertex)
                $orig = new Vertex (array('x' => $kwargs['orig']->getX(), 'y' => $kwargs['orig']->getY(), 'z' => $kwargs['orig']->getZ()));
            else
                $orig = new Vertex (array('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1.0));
            $this->_x = $kwargs['dest']->getX() - $orig->getX();
            $this->_y = $kwargs['dest']->getY() - $orig->getY();
            $this->_z = $kwargs['dest']->getZ() - $orig->getZ();
            $this->_w = $kwargs['dest']->getW() - $orig->getW();
        }
        if (self::$verbose === TRUE)
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) constructed" . PHP_EOL , $this->_x, $this->_y, $this->_z, $this->_w);
        return;
    }

    public function getX($x) {
        return ($this->_x);
    }

    public function getY($y) {
        return ($this->_y);
    }

    public function getZ($z) {
        return ($this->_z);
    }

    public function getW($w) {
        return ($this->_w);
    }

    public function magnitude() {
        $magn = (float)(sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)));
        return ($magn);
    }

    public function normalize() {
        $magn = $this->magnitude();
        return (new Vector (
                array('dest' => new Vertex (
                    array('x' => $this->_x / $magn, 
                          'y' => $this->_y / $magn, 
                          'z' => $this->_z / $magn, 
                          'w' => 1.0)))));
    }

    public function add(Vector $rhs) {
        return (new Vector (
                array('dest' => new Vertex (
                    array('x' => $this->_x + $rhs->_x, 
                          'y' => $this->_y + $rhs->_y, 
                          'z' => $this->_z + $rhs->_z, 
                          'w' => 1.0)))));
    }

    public function sub(Vector $rhs) {
        return (new Vector (
                array('dest' => new Vertex (
                    array('x' => $this->_x - $rhs->_x, 
                          'y' => $this->_y - $rhs->_y, 
                          'z' => $this->_z - $rhs->_z, 
                          'w' => 1.0)))));
    }

    public function opposite() {
        return (new Vector (
                array('dest' => new Vertex (
                    array('x' => $this->_x * -1, 
                          'y' => $this->_y * -1, 
                          'z' => $this->_z * -1, 
                          'w' => 1.0)))));
    }

    public function scalarProduct($k) {
        return (new Vector (
                array('dest' => new Vertex (
                    array('x' => $this->_x * $k, 
                          'y' => $this->_y * $k, 
                          'z' => $this->_z * $k, 
                          'w' => 1.0)))));
    }

    public function dotProduct (Vector $rhs) {
        $dotproduct = (float)($this->_x * $rhs->_x + $this->_y * $rhs->_y + $this->_z * $rhs->_z);
        return ($dotproduct);
    }

    public function cos(Vector $rhs) {
        $magn = (float)(sqrt(pow($this->_x, 2) + pow($this->_y, 2) + pow($this->_z, 2)));
        $cos = (float)($this->dotProduct($rhs) / ($magn * $rhs->magnitude()));
        return ($cos);
    }

    public function crossProduct(Vector $rhs) {
        return (new Vector (
            array('dest' => new Vertex (
                array('x' => $this->_y * $rhs->_z - $this->_z * $rhs->_y, 
                      'y' => $this->_z * $rhs->_x - $this->_x * $rhs->_z, 
                      'z' => $this->_x * $rhs->_y - $this->_y * $rhs->_x, 
                      'w' => 1.0)))));
    }

    function __toString() {
        return (sprintf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )", $this->_x, $this->_y, $this->_z, $this->_w));
    }

    public static function doc() {
        return (file_get_contents('Vector.doc.txt') . PHP_EOL );
    }

    public function __destruct() {
        if (self::$verbose === TRUE)
            printf("Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f ) destructed" . PHP_EOL , $this->_x, $this->_y, $this->_z, $this->_w);
        return;
    }
}
?>
