<?php
declare(strict_types =1);

class Categoria {
  private string $nombre;

  public function __construct(string $n){
    $this->nombre = $n;
  }

    public function obtenerNombre(): string{
    return $this->nombre;
  }
  declare(strict_types=1);

$intento = new Producto(1, 'Mouse', new Categoria('Periféricos'), 499.00, 'Texto', 25, 'img.png');
echo $intento->obtenerId();
echo $intento->obtenerNombre();

?>