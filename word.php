<?php
error_reporting(E_ERROR);
require 'vendor/autoload.php';


$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('Template.docx');
 
$templateProcessor->setValue('titre', 'AAA');
$templateProcessor->setValue('source', 'Hespress');
$templateProcessor->setValue('auteur', 'Me');
$templateProcessor->setValue('contenu', '

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sed scelerisque arcu. Nam pharetra nec sem sed tempor. Pellentesque convallis tincidunt suscipit. Integer non arcu in eros tristique hendrerit. Etiam sit amet metus felis. Mauris quis lorem eu dolor bibendum sollicitudin. Aenean dolor turpis, fringilla eu lectus quis, congue vestibulum arcu. Sed luctus blandit lobortis.

Nulla dignissim viverra nulla ultricies ullamcorper. Nullam augue enim, auctor sed consequat eget, tincidunt nec ipsum. Pellentesque posuere posuere arcu vitae scelerisque. Suspendisse odio metus, mattis eget enim in, cursus pretium dolor. Ut velit ante, tristique ac nisi sit amet, maximus vestibulum ex. Donec sagittis, massa et mollis malesuada, ante ligula iaculis purus, eu egestas leo ante et mauris. Proin porttitor pulvinar vehicula. Pellentesque a faucibus sapien, malesuada consequat nibh. Nulla a est hendrerit, rhoncus nisi in, bibendum metus. Nam eleifend tellus dui, ut scelerisque nulla elementum vel.

Curabitur a condimentum nunc. Quisque rhoncus velit aliquam dapibus tempus. Curabitur efficitur lectus a condimentum sagittis. Nam eget nisi non leo tincidunt euismod. Donec convallis quam ut magna mattis porta. Aliquam eget commodo tellus, ut placerat neque. Quisque finibus velit sit amet lobortis tempor.

Donec imperdiet metus magna, in luctus eros venenatis eget. Vestibulum varius velit justo, mattis rutrum risus ornare sed. Phasellus eros orci, tincidunt in neque non, facilisis egestas tellus. Aenean tempor at mi quis rutrum. Etiam varius, ipsum eu feugiat fermentum, enim ex ullamcorper ante, nec auctor mi neque nec eros. Maecenas a mollis erat. Mauris ut lacinia elit.

Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam tincidunt quam et justo consequat, sit amet malesuada mi pretium. Proin sed ante vel odio scelerisque accumsan. Sed sapien nulla, tincidunt id scelerisque dictum, iaculis et ligula. Maecenas nibh tellus, dignissim sed blandit in, scelerisque rhoncus ex. Curabitur sed nisl ut leo dignissim ornare ut at erat. Morbi consequat, orci sed accumsan accumsan, libero est tincidunt metus, id varius quam nunc vel tortor. Duis fermentum arcu et nisi varius, a suscipit ligula mattis. Nullam dapibus diam sit amet congue egestas. In accumsan elit elit, consequat vehicula erat ornare at. Nunc pretium, odio ut bibendum sodales, nulla nisl pulvinar tortor, at varius felis diam eu nisi. Maecenas nunc ipsum, varius et fermentum eu, lobortis eget sapien. Pellentesque gravida cursus tellus, vitae viverra ex vestibulum eget. ');

// $templateProcessor->saveAs('NewWordFile.docx'); 
try {
    header("Content-Disposition: attachment; filename='article.docx'");
  $templateProcessor->saveAs('php://output');
} catch (\Throwable $th) {
    
}





