<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use \app\modules\registro\models\Registro;
use \app\modules\registro\models\Almacen;
use \app\modules\registro\models\Cadena;
use \app\modules\registro\models\Categoria;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CategoriaAlmacenInitController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionStart()
    {
        $registros = Registro::find()->all();
        foreach($registros as $r){
            //La cadena es la primera palabra
            $words = explode(' ',$r->almacen);
            $regcadena = $words[0];
            $cadena = Cadena::find()->where(['titulo'=>$regcadena])->one();
            if(!$cadena){
                $cadena = new Cadena;
                $cadena->titulo = $regcadena;
                $cadena->detachBehavior('blameable');
                $cadena->created_by = 1;
                $cadena->save();
            }
            $regalmacen = "";
            if(count($words) > 1){    
                $regalmacen = implode(' ', array_slice($words, 1, count($words)-1));
                $almacen = Almacen::find()->where(['identificador'=>$regalmacen,'cadena_id'=>$cadena->id])->one();
            } else {
                $almacen = null;
            }
            if(!$almacen){
                $almacen = new Almacen;
                $almacen->cadena_id = $cadena->id;
                $almacen->identificador = $regalmacen;
                $almacen->detachBehavior('blameable');
                $almacen->created_by = 1;
                $almacen->save();
            }
            $regcategoria = $r->categoria;
            $categoria = Categoria::find()->where(['titulo'=>$r->categoria])->one();
            if(!$categoria){
                $categoria = new Categoria;
                $categoria->titulo = $regcategoria;
                $categoria->descripcion = $r->elemento;
                $categoria->detachBehavior('blameable');
                $categoria->created_by = 1;
                $categoria->save();
            } elseif(strpos($categoria->descripcion,$r->elemento)===false) {
                $o = explode(', ',$categoria->descripcion);
                $o[] = $r->elemento;
                $categoria->descripcion = implode(', ',$o);
                $categoria->save();
            }
            $r->cadena_id = $cadena->id;
            $r->almacen_id = $almacen->id;
            $r->categoria_id = $categoria->id;
            $r->save();
        }
    }
}
