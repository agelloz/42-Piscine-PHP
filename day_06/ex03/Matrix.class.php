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

	protected $matrix = array();
        private $_preset;
        private $_scale;
        private $_angle;
        private $_vtc;
        private $_fov;
        private $_ratio;
        private $_near;
        private $_far;
	static private $_cc = NULL;

	public function __construct(array $kwargs) {
		if (array_key_exists('preset', $kwargs) == FALSE)
			return;
		$this->_preset = $kwargs['preset'];
            	for ($i = 0; $i < 16; $i++)
                	$this->matrix[$i] = 0;
		if ($kwargs['preset'] == self::IDENTITY)
                	$this->identity(1);
		elseif ($kwargs['preset'] == 'SCALE' && array_key_exists('scale', $kwargs))
		{
			$this->_scale = $kwargs['scale'];
                	$this->identity($this->_scale);
		}
		elseif ($kwargs['preset'] == self::RX && array_key_exists('angle', $kwargs))
		{
			$this->_angle = $kwargs['angle'];
                	$this->rotation_x();
		}
		elseif ($kwargs['preset'] == self::RY && array_key_exists('angle', $kwargs))
		{
			$this->_angle = $kwargs['angle'];
                	$this->rotation_y();
		}
		elseif ($kwargs['preset'] == self::RZ && array_key_exists('angle', $kwargs))
		{
			$this->_angle = $kwargs['angle'];
                	$this->rotation_z();
		}
		elseif ($kwargs['preset'] == self::TRANSLATION && array_key_exists('vtc', $kwargs))
		{
			$this->_vtc = $kwargs['vtc'];
                	$this->translation();
		}
		elseif ($kwargs['preset'] == self::PROJECTION && array_key_exists('fov', $kwargs)
							  && array_key_exists('ratio', $kwargs)
							  && array_key_exists('near', $kwargs)
							  && array_key_exists('far', $kwargs))
		{
			$this->_fov = $kwargs['fov'];
			$this->_ratio = $kwargs['ratio'];
			$this->_near = $kwargs['near'];
			$this->_far = $kwargs['far'];
                	$this->projection();
		}
		else
			return;
		$this->_cc = $kwargs['preset'];
                if (self::$verbose == TRUE && $this->_cc) 
		{
                    if ($this->_preset == Self::IDENTITY)
                        echo "Matrix " . $this->_preset . " instance constructed" . PHP_EOL;
                    else
                        echo "Matrix " . $this->_preset . " preset instance constructed" . PHP_EOL;
                }
		return;
	}

        private function identity($scale)
        {
            $this->matrix[0] = $scale;
            $this->matrix[5] = $scale;
            $this->matrix[10] = $scale;
            $this->matrix[15] = 1;
        }

        private function translation()
        {
            $this->identity(1);
            $this->matrix[3] = $this->_vtc->getX($this->_vtc);
            $this->matrix[7] = $this->_vtc->getY($this->_vtc);
            $this->matrix[11] = $this->_vtc->getZ($this->_vtc);
        }

        private function rotation_x()
        {
            $this->identity(1);
            $this->matrix[0] = 1;
            $this->matrix[5] = cos($this->_angle);
            $this->matrix[6] = -sin($this->_angle);
            $this->matrix[9] = sin($this->_angle);
            $this->matrix[10] = cos($this->_angle);
        }

        private function rotation_y()
        {
            $this->identity(1);
            $this->matrix[0] = cos($this->_angle);
            $this->matrix[2] = sin($this->_angle);
            $this->matrix[5] = 1;
            $this->matrix[8] = -sin($this->_angle);
            $this->matrix[10] = cos($this->_angle);
        }

        private function rotation_z()
        {
            $this->identity(1);
            $this->matrix[0] = cos($this->_angle);
            $this->matrix[1] = -sin($this->_angle);
            $this->matrix[4] = sin($this->_angle);
            $this->matrix[5] = cos($this->_angle);
            $this->matrix[10] = 1;
        }

        private function projection()
        {
            $this->identity(1);
            $this->matrix[5] = 1 / tan(0.5 * deg2rad($this->_fov));
            $this->matrix[0] = $this->matrix[5] / $this->_ratio;
            $this->matrix[10] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
            $this->matrix[14] = -1;
            $this->matrix[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
            $this->matrix[15] = 0;
        }

        public function mult(Matrix $rhs)
        {
            $tmp = array();
            for ($i = 0; $i < 16; $i += 4) {
                for ($j = 0; $j < 4; $j++) {
                    $tmp[$i + $j] = 0;
                    $tmp[$i + $j] += $this->matrix[$i + 0] * $rhs->matrix[$j + 0];
                    $tmp[$i + $j] += $this->matrix[$i + 1] * $rhs->matrix[$j + 4];
                    $tmp[$i + $j] += $this->matrix[$i + 2] * $rhs->matrix[$j + 8];
                    $tmp[$i + $j] += $this->matrix[$i + 3] * $rhs->matrix[$j + 12];
                }
            }
            $matrice = new Matrix($tmp);
            $matrice->matrix = $tmp;
            return $matrice;
        }

        public function transformVertex(Vertex $vtx)
        {
            $tmp = array();
            $tmp['x'] = ($vtx->getX() * $this->matrix[0]) + ($vtx->getY() * $this->matrix[1]) + ($vtx->getZ() * $this->matrix[2]) + ($vtx->getW() * $this->matrix[3]);
            $tmp['y'] = ($vtx->getX() * $this->matrix[4]) + ($vtx->getY() * $this->matrix[5]) + ($vtx->getZ() * $this->matrix[6]) + ($vtx->getW() * $this->matrix[7]);
            $tmp['z'] = ($vtx->getX() * $this->matrix[8]) + ($vtx->getY() * $this->matrix[9]) + ($vtx->getZ() * $this->matrix[10]) + ($vtx->getW() * $this->matrix[11]);
            $tmp['w'] = ($vtx->getX() * $this->matrix[11]) + ($vtx->getY() * $this->matrix[13]) + ($vtx->getZ() * $this->matrix[14]) + ($vtx->getW() * $this->matrix[15]);
            $tmp['color'] = $vtx->getColor();
            $vertex = new Vertex($tmp);
            return $vertex;
        }

        function __toString()
        {
            $tmp = "M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL;
            $tmp .= "-----------------------------" . PHP_EOL;
            $tmp .= "x | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL;
            $tmp .= "y | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL;
            $tmp .= "z | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL;
            $tmp .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
            return (vsprintf($tmp, array($this->matrix[0], $this->matrix[1], $this->matrix[2], $this->matrix[3], 
					 $this->matrix[4], $this->matrix[5], $this->matrix[6], $this->matrix[7], 
					 $this->matrix[8], $this->matrix[9], $this->matrix[10], $this->matrix[11], 
					 $this->matrix[12], $this->matrix[13], $this->matrix[14], $this->matrix[15])));
        }

	public static function doc() {
		return (file_get_contents('Matrix.doc.txt') . PHP_EOL );
	}

	public function __destruct() {
		if (self::$verbose === TRUE)
			printf("Matrix instance destructed" . PHP_EOL );
	}
}
?>
