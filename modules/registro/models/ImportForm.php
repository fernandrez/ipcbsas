<?php
namespace app\modules\registro\models;

use yii\base\Model;
use yii\web\UploadedFile;
use app\modules\registro\models\Almacen;
use app\modules\registro\models\Cadena;

class ImportForm extends Model
{
  /**
   * @var UploadedFile|Null file attribute
   */
  public $file, $cadena_id, $almacen_id, $fecha, $elemento, $categoria, $unidad, $precio, $cantidad, $marca, $descripcion, $start_row;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
      return [
          [['file','cadena_id', 'almacen_id','fecha','elemento','categoria','unidad','precio'], 'required'],
          [['file'], 'file'],
          [['cadena_id', 'almacen_id','elemento','categoria','unidad','precio'], 'integer'],
          [['fecha'], 'safe'],
      ];
  }

  public function init(){
      $this->start_row = 0;
      $this->elemento = 0;
      $this->categoria = 1;
      $this->unidad = 2;
      $this->precio = 3;
      $this->cantidad = 4;
      $this->marca = 5;
      $this->descripcion = 6;
  }

  public function importGeneric($inputFile){
    $cadena = Cadena::find()->where(['id'=>$this->cadena_id])->one();
    $almacen = Almacen::find()->where(['id'=>$this->almacen_id])->one();
    if(strtolower($cadena->titulo)=='los prados' && strtolower($almacen->identificador)=='frigorifico central'){
      return $this->importPradosFrigorificoCentral($inputFile);
    } elseif(strtolower($cadena->titulo)=='hugo' && strtolower($almacen->identificador)=='central'){
      $this->start_row = 1;
      return $this->importUsual($inputFile);
    } else {
      return $this->importUsual($inputFile);
    }
  }

  public function importUsual($inputFile){
    try{
      $inputFileType=\PHPExcel_IOFactory::identify($inputFile);
      $objReader=\PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel=$objReader->load($inputFile);
    }catch(Exception $e){
      die('Error');
    }
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow=$sheet->getHighestRow();
    $highestCol=$sheet->getHighestColumn();
    $highestColNumber=ord(strtolower($highestCol))-97;
    if($this->elemento <= $highestCol &&
    $this->categoria <= $highestCol &&
    $this->unidad <= $highestCol &&
    $this->precio <= $highestCol)
      for($row=$this->start_row;$row<=$highestRow;$row++){
        $rowData=$sheet->rangeToArray('A'.$row.':'.$highestCol.$row,NULL,TRUE,FALSE);
        $categoria=$rowData[0][$this->categoria];
        $elemento=$rowData[0][$this->elemento];
        $unidad=strtolower($rowData[0][$this->unidad]);
        $unidad=($unidad=='unidad')?'u':$unidad;
        $precio=$rowData[0][$this->precio];
        $marca=$this->marca<=$highestColNumber?$rowData[0][$this->marca]:'';
        $descripcion=$this->descripcion<=$highestColNumber?$rowData[0][$this->descripcion]:'';
        $cantidad=$this->cantidad<=$highestColNumber?$rowData[0][$this->cantidad]:1;
        //Preexistence
        $catdb=Categoria::find()->where(['titulo'=>$categoria])->one();
        if(!$catdb){
          $catdb=new Categoria;
          $catdb->titulo=$categoria;
          $catdb->descripcion=$categoria;
          $catdb->save();
        }
        $registro=new Import;
        $registro->cadena_id=$this->cadena_id;
        $registro->almacen_id=$this->almacen_id;
        $registro->categoria_id=$catdb->id;
        $registro->elemento=$elemento;
        $registro->fecha=$this->fecha;
        $registro->cantidad=$cantidad;
        $registro->unidad=$unidad;
        $registro->precio=$precio;
        $registro->marca=$marca;
        $registro->descripcion=$descripcion;
        $registro->save();
      }
  }

  public function importPradosFrigorificoCentral($inputFile){
    try{
      $inputFileType=\PHPExcel_IOFactory::identify($inputFile);
      $objReader=\PHPExcel_IOFactory::createReader($inputFileType);
      $objPHPExcel=$objReader->load($inputFile);
    }catch(Exception $e){
      die('Error');
    }
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow=$sheet->getHighestRow();
    $highestCol=$sheet->getHighestColumn();
    for($row=2;$row<=$highestRow;$row++){
      $rowData=$sheet->rangeToArray('A'.$row.':'.$highestCol.$row,NULL,TRUE,FALSE);
      if($rowData[0][1]==null){
        $categoria=$rowData[0][0];
        $after=strpos($categoria,'- ');
        if($after!==false){
          $categoria=substr($categoria,$after+2);
        }
        $catdb=Categoria::find()->where(['titulo'=>$categoria])->one();
        if(!$catdb){
          $catdb=new Categoria;
          $catdb->titulo=$categoria;
          $catdb->descripcion=$categoria;
          $catdb->save();
        }
        continue;
      } else {
        $registro=new Import;
        $registro->cadena_id=$this->cadena_id;
        $registro->almacen_id=$this->almacen_id;
        $registro->categoria_id=$catdb->id;
        $registro->elemento=$rowData[0][1];
        $registro->fecha=$this->fecha;
        $registro->cantidad=1;
        $registro->unidad='kg';
        if(strpos($registro->elemento,'unidad')!==false){
          $registro->unidad='u';
        }
        $registro->precio=$rowData[0][2];
        $registro->save();
      }
    }
  }
}
?>
