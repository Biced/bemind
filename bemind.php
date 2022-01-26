// add script to page תשובות-לשאלון-התניות
function ti_custom_javascript() {
  if (is_page ('780')) {
    ?>

<style>
   .break-wrap{ word-wrap: break-word}

    .show{
        display: block !important;
    }
    .elementor-780 .elementor-section-wrap{
        display: flex;
    flex-direction: column;
    }
    .order{
           order: 1;
    }
</style>
       <script src="https://cdn.jsdelivr.net/npm/chart.js">
</script>
<script src="https://wizardly-bose-f1d44d.netlify.app/testing.js"></script>


    <?php
  }
}
add_action('wp_footer', 'ti_custom_javascript');

add_action( 'elementor_pro/forms/new_record', function( $record, $handler ) {
    //make sure its our form
    $form_name = $record->get_form_settings( 'form_name' );

    // Replace MY_FORM_NAME with the name you gave your form
    if ( 'טופס' !== $form_name ) {
        return;
    }

    $raw_fields = $record->get( 'fields' );
    $fields = [];
    foreach ( $raw_fields as $id => $field ) {
        $fields[ $id ] = $field['value'];

    }

	$new_numbers_array = [];
    $final_numbers_array = [];


for($x=1 ; $x < 34 ; $x+=3){
$final =  $fields[$x]+$fields[$x+1]+$fields[$x+2];
array_push($final_numbers_array, $final);
}

$highest_three = $highest_two = $highest = 0;
$highest_two_index = $highest_index = 0;
$final_numbers_array_total = count($final_numbers_array);
	for($i=0; $i<$final_numbers_array_total ; $i++){
	if($final_numbers_array[$i] > $highest){
$highest = $final_numbers_array[$i];
$highest_index = $i+1;
}}
	for($i=0; $i<$final_numbers_array_total ; $i++){
if(($i != ($highest_index - 1)) && ($final_numbers_array[$i]>$highest_two)){
$highest_two = $final_numbers_array[$i];
	$highest_two_index = $i+1;
}}
	for($i=0; $i<$final_numbers_array_total ; $i++){
if(($i != ($highest_two_index - 1)) && ($i != ($highest_index - 1)) && ($final_numbers_array[$i]>$highest_three)){
$highest_three = $final_numbers_array[$i];

}


	}
if(($highest_two === $highest_three) && ($highest_two === $highest) ){
    $highest_two_index = $highest_index = 0;
}
if($highest_two === $highest_three){
    $highest_two_index = 0;
}


	if(($highest_two_index != 0) && ($highest_index != 0)){
		$values ='';
 foreach($final_numbers_array as $value){
    $values = $values.$value.'&';
 };
 $values = $values.$highest_index.'&'.$highest_two_index.'&'.$fields['name'];
$link = site_url( $path = 'תשובות-לשאלון-התניות/?'.$values);
	$gender_message1 = "";
	$gender_message2 = "";
if($fields['sex'] == "זכר"){
	$gender_message1 ="איזה כיף שבחרת להעמיק את ההכרות עם עצמך ולהצטרף למסע גילוי מנגנוני התודעה שלך.
";
	$gender_message2 ="ממש עוד רגע תגלה מהו מנגנון התודעה הדומיננטי שיצא לך בשאלון שמילאת וכיצד הוא לעיתים מפריע לך להשיג דווקא את מה שאתה הכי רוצה. מוכן?
";
}else{
	$gender_message1 = "איזה כיף שבחרת להעמיק את ההכרות עם עצמך ולהצטרף למסע גילוי מנגנוני התודעה שלך.
";
	$gender_message2 ="ממש עוד רגע תגלי מהו מנגנון התודעה הדומיננטי שיצא לך בשאלון שמילאת וכיצד הוא לעיתים מפריע לך להשיג דווקא את מה שאת הכי רוצה. מוכנה?
";
}

$to = $fields['email']; // note the comma

// Subject
$subject = 'מנגנוני התודעה שלך';

// Message
$message = '
<html>
<head>
  <title>מנגנוני התודעה שלך</title>
</head>
<body dir="rtl">

  <h2> היי '.$fields['name'].' </h2>
  <p>'.$gender_message1.'</p>
  <p>'.$gender_message2.'</p>
  <a href='.$link.'>לגילוי המנגנון לחצ/י על הלינק
</a>
<p>מחכות לך לאחר הגילוי
</p>
<p>צוות BeMind
</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers = ['MIME-Version: 1.0','Content-type: text/html; charset=iso-8859-1'];
mail($to, $subject, $message, implode("\r\n", $headers));
		$handler->add_response_data( 'redirect_url', $link );
	}else{

		$handler->add_error( 'error', 'error' );
	}
wp_remote_post('https://script.google.com/macros/s/AKfycbyKAYwD23zQ6EULFFsenJb_D807oUAi-TLn9MIjX5hoxo2F0bVUyZQOPszmaF3GaWSq/exec', [
        'body' => $fields,
    ]);


	$to = 'biced.nff@gmail.com'; // note the comma

// Subject
$subject = 'new message from bemind';
// 	$link= "https://docs.google.com/spreadsheets/d/1NxJxEwOxX8YKTvSo7YkO3TA1WXtqsxvddNoa_UyXRTc";
	// Message
$message = "https://docs.google.com/spreadsheets/d/1NxJxEwOxX8YKTvSo7YkO3TA1WXtqsxvddNoa_UyXRTc";
	mail($to, $subject, $message, implode("\r\n", $headers));

}, 10, 2 );