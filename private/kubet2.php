<?php
require_once('simple_html_dom.php');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://trangkeo.com/keo/keonhacai/ajax_tyle.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'authority: trangkeo.com',
    'accept: */*',
    'accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
    'cache-control: no-cache',
    'content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'origin: https://trangkeo.com',
    'pragma: no-cache',
    'referer: https://trangkeo.com/odds/',
    'sec-ch-ua: "Google Chrome";v="117", "Not;A=Brand";v="8", "Chromium";v="117"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest',
    'accept-encoding: gzip',
]);
// curl_setopt($ch, CURLOPT_COOKIE, '_lscache_vary=4ddb26e14725e5fbeff2d8c64a58e8a6; PHPSESSID=msgr8almu81jj9ifjq06nauuc6');
curl_setopt($ch, CURLOPT_POSTFIELDS, 'device=desktop&type=live');
curl_setopt($ch, CURLOPT_ENCODING, "UTF-8" );
// $response = curl_exec($ch);
curl_close($ch);

// $content = str_replace('\"','',json_decode($response,true)['html']);
// $filePath = "kubet.txt";
// if (file_put_contents($filePath, $content) !== false) {
//     // echo "Content saved to the file successfully.";
// }


// $pattern = '/<tr><td style="position: relative;padding-right: 35px;"><b class="chutyle">(.*?)<\/b><\/td><\/tr>/';
// preg_match_all($pattern, $content, $matchesdoia);
// echo '<pre>';
// print_r($matchesdoia[1]);
// echo '</pre>';

// $patterndoib = '/<tr><td><b class="chutyle">(.*?)<\/b><\/td><\/tr>/';
// preg_match_all($patterndoib, $content, $matchesdoib);
// echo '<pre>';
// print_r($matchesdoib[1]);
// echo '</pre>';


echo $html = file_get_html('kubet.txt');
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

$chuoi_con ='<tr class="keo-search dong keo-dong';
$vi_tri = strpos($html, $chuoi_con);
if ($vi_tri !== false) {
    echo "a: " . $vi_tri;
}
$chuoi_con2 = '</td>                         </tr>';
$vi_tri2 = strpos($html, $chuoi_con2, $vi_tri);
if ($vi_tri2 !== false) {
    echo "b: " . $vi_tri2;
}
$partBefore = substr($html, 0, $vi_tri); 
$partAfter = substr($html, $vi_tri2 + 5);   


$modifiedString = $partBefore . $partAfter;
echo $pos = strpos(substr($html, $vi_tri, $vi_tri2 + 5), 'Hòa');
if($pos !== false){
}else{
    echo $html;
    
}


// if ($html) {
//     $valuekey   = 0;
//     $doichap    = '';
//     foreach ($html->find('.odd-competition') as $html2) {
//         foreach($html2->find('.TYLETT_4 strong') as $value){
//             echo $value->innertext;
//             $tyle = 0;
//             foreach ($html2->find('.keo-search.dong.keo-dong:eq(0) td.TYLETT_3b table tbody tr td') as $key => $element) {
//                 $elementsWith       = $element->find('.chutyle');
//                 if( isset($elementsWith[0]) ){
//                     $doichap        .= $elementsWith[0]->innertext . " chấp";
//                     echo '<br>';
//                 }else{
//                     $doib           = $element->innertext;
//                     if($doib == '<span style="color:rgb(96, 96, 96);">Hòa</span>'){
//                     }else{
//                         $doichap    .= $doib;
//                         echo '<br>';

//                     }
//                     if( $key == 2 || $key == $valuekey ){
//                         $valuekey = $key + 3;
//                         echo $doichap;
//                         echo '<br>';
//                         $doichap = '';
                        
//                     }
//                 }
                
//                 foreach ($html2->find('.keo-search.dong.keo-dong:eq(0) TYLETT_3c:eq(0) table tbody tr:eq(0) td b.do font') as $key3 => $element2) {
//                     echo $tyle = $key3.' | '.$element2->innertext;
//                     echo '<br>';
//                 }
                
                
//                 // foreach ($html2->find('.keo-search.dong.keo-dong:eq(0) td.TYLETT_3c:eq(0) table tbody tr:eq(0) td:eq(0) b.do font') as $key2 => $element2) {
//                 //         echo $tyle = $key.' | '.$element2->innertext;
//                 //         echo '<br>';
//                 //         echo '<br>';
//                 // }
                
                
//             }
//         }


        // foreach ($html->find('.odd-competition .keo-search.dong.keo-dong:eq(0) .TYLETT_3b table tbody tr td') as $key => $element) {
        //     $elementsWith       = $element->find('.chutyle');
        //     if( isset($elementsWith[0]) ){
        //         $doichap        .= $elementsWith[0]->innertext . " chấp <br>";
        //     }else{
        //         $doib           = $element->innertext;
        //         if($doib == '<span style="color:rgb(96, 96, 96);">Hòa</span>'){
        //         }else{
        //             $doichap    .= $doib;
        //             echo '<br>';

        //         }
        //         if( $key == 2 || $key == $valuekey ){
        //             $valuekey = $key + 3;
        //             echo $doichap;
        //             echo '<br>';
        //             $doichap = '';

        //         }
        //     }
        // }
//     }
//     $html->clear();
// } 





echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


// $pos = strpos($content, '<tr class="odd-competition" '); 
// if ($pos !== false) {
//     echo "Position of 'World' is: " . $pos; 
// }
// $pos2 = strpos($content, '</tbody></table></td></tr>'); 
// if ($pos2 !== false) {
//     echo "Position of 'World' is: " . $pos2; 
// }
// $substring = substr($content, $pos, $pos2);
// echo $substring;


// $positions = array();
// $startPos = 0;
// while (($pos = strpos($content, '<tr class="odd-competition" ', $startPos)) !== false) {
//     $positions[] = $pos;
//     $startPos = $pos + 1;
// }
// foreach ($positions as $position) {
//     echo $position;
//     $pos2 = strpos($content, '</tbody></table></td></tr>', $position);
//     $substring = substr($content, $position, $pos2);
//     echo $substring;
// }





