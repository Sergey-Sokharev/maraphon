<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package maraphon
 */
?>
	<footer id="colophon" class="site-footer">    
		
     <table class="footer_table">
        <tr>
            <td colspan="3" style="padding-left: 20px; padding-top: 10px; font-size: 22px">Екатерина Войтенко </td> 
            <td class="footer_contacts" style="padding-top: 10px;">Контакты</td>
        </tr>
        
        <tr>
            <td colspan="3" style="padding-left: 20px; font-size: 22px;">Фитнес тренер</td> 
            <td class="footer_contacts"><a href="tel:+79528986463">Телефон: 8-952-898-64-63</a></td>
        </tr>
        
        <tr>
            <td colspan="2" rowspan="3" ><img class="footer-foto" src="<?php echo content_url() ?>/uploads/footer-photo-150x150-1.jpg" alt="Войтенко"></td> 
            <td class="slogan">Твое идеальное тело в надежных руках</td>
            <td class="slogan_hide"></td>
            <td class="footer_contacts"><a href="https://api.whatsapp.com/send?phone=79528986463" target="_blank" >Whatsapp: +79528986463</a></td>
        </tr>
        
         <tr>
            <td></td>
            <td class="footer_contacts"><a href="mailto:info@maraphon.online">E-mail: info@maraphon.online</a></td>
        </tr>
        
         <tr>
            <td></td>
            <td class="footer_contacts" style="font-size: 16px !important;"><a href="http://maraphon.online/privacy-policy/" target="_blank">Политика конфиденциальности</a></td>
        </tr>
      
        <tr>
		 	<td colspan="4" style="font-size: 16px !important; padding-left: 5px;"> © <?php echo current_time("Y"); ?> Марафон Онлайн от Войтенко Екатерины</td>
        </tr>
     </table>

	</footer> 



</body>
</html>