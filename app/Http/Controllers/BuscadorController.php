<?php

namespace App\Http\Controllers;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;


use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function captura ($id){
        $client = new Client();
        $crawler = $client->request('GET', 'http://www.cne.gob.ve/web/registro_electoral/ce.php?nacionalidad=V&cedula='.$id);

        //dd($crawler);
        // Muerto 1184
        // No Registrado
        //return $Condi = strlen($crawler->text());
        $texto = $crawler->text();
        $Condi = strlen($texto);
        
        if ($Condi < 720) {
            $nombre = $crawler->filter('td > b')->eq(2)->text();
            $estado = $crawler->filter('tr > td ')->eq(15)->text();
            $municipio = $crawler->filter('tr > td ')->eq(17)->text();
            $parroquia = $crawler->filter('tr > td ')->eq(19)->text();
            $registradoEn = $crawler->filter('tr > td ')->eq(25)->text();
            
            return $nombre.'<br>'.$estado.'<br>'.$municipio.'<br>'.$parroquia.'<br>'.$registradoEn;
        }else {
            switch ($Condi) {
                case '720':
                    return 'No Registrado';
                case '1184':
                    return 'Ha Fallecido'.$texto;
                case '1185':
                    return 'Ha Fallecido'.$texto;
                case '663':
                    return 'Ha Fallecido'.$texto;
                default:
                    return 'Error Inesperado'.$texto;
            }
        }
        
        
       
        /* for ($i=0; $i < 40; $i++) { 
            echo 'Nmro:.'.$i.' '.$crawler->filter('tr > td ')->eq($i)->text().'<br><br>';
        }
        return 'listo'; */

        /* [5]/td/table/tbody/tr[2]/td/table[1]/tbody/tr[3]/td[2] */

        $puroTexto = $crawler->text();
        return $puroTexto;
        $partes = explode('ELECTOR', $puroTexto);
        $partes2 = explode('Municipio', $partes[2]);
        return $partes2[0];

        $crawler->filter('.consulta_re')->each(function ($node) {
            print $node->text()."\n";
        });

        $form = $crawler->selectButton('Buscar')->form();
        $crawler = $client->submit($form, ['nacionalidad' => 'V','cedula' => '28544285']);

        ///html/body/table[2]/tbody/tr/td/table[3]/tbody/tr/td[3]/table/tbody/tr[5]/td/form/table/tbody/tr[2]/td

       /*  $crawler = $crawler->filterXPath('//body/table'); */
        /* $crawler = $crawler->filterXPath('//table/') *//* ->each(function ($node) {
            print $node->text()."\n";
        }) */;

    }
}
