<?php
namespace app\modules\registro\models;

use yii\base\Model;
use yii\web\UploadedFile;

class ImportForm extends Model
{
  /**
   * @var UploadedFile|Null file attribute
   */
  public $file, $cadena_id, $almacen_id, $fecha;

  /**
   * @return array the validation rules.
   */
  public function rules()
  {
      return [
          [['file','cadena_id', 'almacen_id','fecha'], 'required'],
          [['file'], 'file'],
          [['cadena_id', 'almacen_id'], 'integer'],
          [['fecha'], 'safe'],
      ];
  }
  public function importPrados($inputFile){
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
    $catdb=new Categoria;
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
        }
        if($rowData[0][1]!==null){
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
