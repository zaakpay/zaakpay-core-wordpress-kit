Zaakpay Integration Kit for CoreWordpress

Contents:

1) paymentpage.php :- Page template for Payment Page for Zaakpay. This page contains all the input parameters. (You can make any of the parameters hidden by specifying (input type="hidden"))

2) posttozaakpay.php :- Page template for page which will calculate checksum and post parameters to Zaakpay

3) response.php :- Page template for page which will handle the response from Zaakpay.

Instructions:

1) Copy the three .php files into your theme folder i.e. Wordpress installation directory/wp-content/themes/themefolder/

2) Make a new page in your Wordpress admin with title as 'posttozaakpay' and select its page template as 'PostToZaakpayPage'

3) Make a new page in your Wordpress admin with title as 'zaakpayresponse' and select its page template as 'Zaakpay Response Page'

4) Make a new page in your Wordpress admin with any title and select its page template as 'Zaakpay Payment Page'

5) Now in file posttozaakpay.php, please replace your secret key on line 141. 

6) Now in file response.php, please replace your secret key on line 143. 

7) Now in file paymentpage.php, change your merchant identifier on line 28 corresponding to the merchantIdentifier field and replace your server's ip address on line 24 corresponding to the merchantIdAddress field.

8) Now fire up the page corresponding to the page template 'Zaakpay Payment Page' in your browser and test the flow.



Please note that these page templates have been made keeping in mind a default theme page structure. i.e.

<?php
/*
Template Name: "The template name comes here"
*/
?>
<?php get_header(); ?>
<div id="container">
//The custom code comes here
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>

If your theme has a different page structure, you can change it accordingly.