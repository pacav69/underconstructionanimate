<?php
/**
 * @version		$Id: spcofflinepage.php 15 2014-02-06 18:37:15Z SilverPC $
 * @package     Joomla16.Tutorials
 * @subpackage  Components
 * @copyright   Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author      SilverPC
 * @license http://www.gnu.org/licenses GNU/GPL
 */

 /* Copyright (c) 2003 Default Corporation. */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemSpcofflinepage extends JPlugin
{
	
	

	function onAfterRender()
    {
		
        $params   = $this->params;




$app = JFactory::getApplication();

$user = JFactory::getUser() ; 






        
$cnx=0;

$user_group=explode(',',$params->get('groupe_user'));
foreach ($user_group as $key => $row) {
if(isset($user->groups[$row])) 
{
	if($user->groups[$row]==$row ){
  $cnx=1;
}
else{
  $cnx=0;
}

}

}	



   

    
      if($cnx==0){
      		
      

      if(!$app->isAdmin() ) {

        $head  = "<head>
		  <meta charset=utf-8 />
		  <link href=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/css/spc_offline_page.css\" rel=\"stylesheet\" type=\"text/css\" />
		  		  <link href=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/css/animate.css\" rel=\"stylesheet\" type=\"text/css\" />

                  <link href=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/css/responsive.css\" rel=\"stylesheet\" type=\"text/css\" />
		  ";

		if($params->get('favicon')!=''){
		  	$head.="<link href=\"".$params->get('favicon')."\" rel=\"shortcut icon\" type=\"image/vnd.microsoft.icon\" />";
		}

		$head.="<script type=\"text/javascript\" src=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/js/jquery.js\" ></script>
		  <script type=\"text/javascript\" src=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/js/jquery.plugin.js\" ></script>
		  <script type=\"text/javascript\" src=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/js/prefixfree.mins.js\" ></script>
		";


		$lang = JFactory::getLanguage();
		$lang_current=$lang->getTag();
		if($lang_current=='fr-FR')
		 {
		   $head.="<script type=\"text/javascript\" src=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/js/jquery.countdown-fr.js\" ></script>";
		 }
                 else 
                 if($lang_current=='it-IT')
		 {
		   $head.="<script type=\"text/javascript\" src=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/js/jquery.countdown-it.js\" ></script>";
		 }
		else
		 {
		   $head.="<script type=\"text/javascript\" src=\"" . JURI::base() . "plugins/system/spcofflinepage/spcofflinepage/js/jquery.countdown-eng.js\" ></script>";
		 }
			
		
	  
        $head.= " <script>
            jQuery(function () {
	        var austDay = new Date();
	        austDay = new Date('".$params->get('date_lancement')."');
            jQuery('#defaultCountdown').countdown({until: austDay});
	        jQuery('#year').text(austDay.getFullYear());
            });
           </script>

	

		
		<meta name=\"description\" http-equiv=\"Content-Type\" content=\"" . $params->get('description') . "\" />
		<meta name=\"keywords\" http-equiv=\"Content-Type\" content=\"" . $params->get('keywords') . "\" />
		<title>" . $params->get('titre') . "</title>
		</head>
		";


		if($params->get('background')!=''){
			$bg=$params->get('background');
			
		}
		

		$body='';
                
                if($params->get('cover-img')!=''){
                    if($params->get('width-c-img')){
                        $width_img_cover='width="'.$params->get('width-c-img').'%"';
                    }
                    else{
                        $width_img_cover='';
                    }
		  $body.='<center><img src="'.$params->get('cover-img').'" alt="" '.$width_img_cover.' /></center>';
                  
                  
                  if($params->get('connexion')==1)
	{

		$body.='
		<div class="gear"><div class="verticaltext ">'.$params->get('title_cnx').'</div></div>
		<div class="cont_block_login">
		<div class="block-login">
		<div class="close-block-login"></div>
		<form action="'.JRoute::_('index.php', true).'" method="post" id="form-login">
	
		<p id="form-login-username">
			<label for="username">'.JText::_('JGLOBAL_USERNAME').'</label>
			<input name="username" id="username" type="text" class="inputbox" alt="" size="18" />
		</p>
		<p id="form-login-password">
			<label for="passwd">'.JText::_('JGLOBAL_PASSWORD').'</label>
			<input type="password" name="password" class="inputbox" size="18" alt="" id="passwd" />
		</p>
		
		<input type="submit" name="Submit" class="button" value="'.JText::_('JLOGIN').'" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="'.base64_encode(JURI::base()).'" />
		'.JHtml::_("form.token").'

	    </form>
	    </div>
	    </div>
	    <script>
	      jQuery(".gear").click(function () {
            jQuery(".gear .verticaltext").hide(100);
            jQuery(".cont_block_login").animate({left: "-2px"}, 500);
          });
          jQuery(".close-block-login").click(function () {
            
            jQuery(".cont_block_login").animate({left: "-312px"}, 500);
            jQuery(".gear .verticaltext").show(600);
          });        
	    </script>

	    ';
	}
		}
                
                else{
		
		if($params->get('style-bg')==1){
                  $bg_propriete='';
                  if($params->get('background-img')!=''){
                     $bg_propriete.='background-image:url('.$params->get('background-img').'); '; 
                  }  
                 
                  if($params->get('repeat-bg')!=''){
                     $bg_propriete.='background-repeat:'.$params->get('repeat-bg').'; '; 
                  }
                  
                  if($params->get('align-x')!='' || $params->get('align-y')!=''){
                     $bg_propriete.='background-position:'.$params->get('align-x').' '.$params->get('align-y').'; '; 
                  } 
                  if($params->get('cover-bg')){
                    $bg_propriete.='background-size: cover; ';
                  }
                  
                  $body.='<div><div class="all-page" style="'.$bg_propriete.'">';
		}
		
		elseif($params->get('style-bg')==2){
		  $body.='
		  <div>
		  <div class="all-page" style="
		  background: '.$bg.'; /* Old browsers */
          background: -moz-linear-gradient(top, '.$bg.' 0%, '.$bg.' 40%, #fff 40%, #fff 100%); /* FF3.6+ */
          background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#'.$bg.'), color-stop(40%,'.$bg.'), color-stop(40%,#fff), color-stop(100%,#ffff00)); /* Chrome,Safari4+ */
          background: -webkit-linear-gradient(top, '.$bg.' 0%,'.$bg.' 40%,#fff 40%,#fff 100%); /* Chrome10+,Safari5.1+ */
          background: -o-linear-gradient(top, '.$bg.' 0%,'.$bg.' 40%,#fff 40%,#fff 100%); /* Opera11.10+ */
          background: -ms-linear-gradient(top, '.$bg.' 0%,'.$bg.' 40%,#fff 40%,#fff 100%); /* IE10+ */
          background: linear-gradient(top, '.$bg.' 0%,'.$bg.' 40%,#fff 40%,#fff 100%); /* W3C */
          ">
		';
		}
		else{
		  $body.='
		  <div class="spc-bg-r">
		  <div class="all-page spc-bg" >
		';	
		}

		// Header
                $centred='';
                if(!$params->get('code_qr'))
                {
                    $centred='centred';
                }

		$body.='<div class="container-page">

		<div class="header">
		<div class="logo-top '.$centred.'">
		';

		if($params->get('logo'))
		{
                    $propriete_logo="";
                    if($params->get('dimension-logo') && $params->get('type-dimension') )
                        {
                           $propriete_logo.=$params->get('type-dimension').":".$params->get('dimension-logo')."px";
                        }
                    
		  $body.='
		  <img src="'.$params->get('logo').'" alt="logo" style="'.$propriete_logo.'" />
		  ';
		}

		$body.='
		</div>
		
		';

		if($params->get('code_qr'))
		{
	      $body.='<div class="code-qr-top">
		  <img src="'.$params->get('code_qr').'" alt="Code QR" />
		  </div>';
		}
		

		$body.='
		</div>
		';

		$body.='
		  <h1 class="message-acc" style="color:'.$params->get('color_message').'">
		    '.$params->get('message').'
		   </h1>
		';
                
              if($params->get('show_adresse') || $params->get('show_contact') || $params->get('show_social'))
		{
                  
              
		$body.='<div class="blocks">
		<div class="cont-blocks">
		';

            if($params->get('show_adresse'))
            {
		    $body.='
		     <div class="block">
		      <h2>'.$params->get('title_adress').'</h2>
		      <div class="cont-block">';
                    if($params->get('show_block_l_html')){
                    $body.=$params->get('block_l_html');
                    }
                    else{
                     $body.=$params->get('adresse');   
                    }
                    
		     $body.='</div>
		     </div>
		    ';
		}



		if($params->get('show_contact')==1)
		{
                    
                      
                          $body.='
                             <div class="block">
                          <h2>'.$params->get('title_coordinate').'</h2>
                          <div class="cont-block">
                         ';
                 
                    if($params->get('show_block_m_html')){
                        $body.=$params->get('block_m_html'); 
                    }
                    else{
                         if($params->get('tel'))
                         {
                            $body.='<span>'.$params->get('lbl_tel').' :</span> '.$params->get('tel').'<br/>';
                         }

                         if($params->get('fax'))
                         {
                            $body.='<span>'.$params->get('lbl_fax').' :</span> '.$params->get('fax').'<br/>';
                         }

                         if($params->get('email'))
                         {
                            $body.='<span>'.$params->get('lbl_email').' :</span> <a href="mailto:'.$params->get('email').'">'.$params->get('email').'</a>';
                         }
                     }
                      

		     $body.='
		      </div>
		      </div>
		      ';
		}


		if($params->get('show_social')==1)
		{
		  
		  $body.='
		    <div class="block">
		       <h2>'.$params->get('title_social').'</h2>
		       <div class="cont-block">
		  ';
                  
                  if($params->get('show_block_r_html')){
                        $body.=$params->get('block_r_html'); 
                  }
                  else{

		       if($params->get('facebook'))
		       {
		         $body.='<a href="'.$params->get('facebook').'" class="facebook-link" target="_blank">Facebook</a>';
		       }

		       if($params->get('twitter'))
		       {
		         $body.='<a href="'.$params->get('twitter').'" class="twitter-link" target="_blank">Twitter</a>';
		       }

		        if($params->get('gplus'))
		       {
		         $body.='<a href="'.$params->get('gplus').'" class="gplus-link" target="_blank">Google Plus</a>';
		       }

		        if($params->get('youtube'))
		       {
		         $body.='<a href="'.$params->get('youtube').'" class="youtube-link" target="_blank">Youtube</a>';
		       }

		        if($params->get('pinterest'))
		       {
		         $body.='<a href="'.$params->get('pinterest').'" class="pinterest-link" target="_blank">Pinterest</a>';
		       }
                    }
		  $body.='
		    </div>
		    </div>
		  ';
		}    
		
		$body.='
		 </div>
		 </div>
		';
                
             }

	    



		if($params->get('show_description')==1)
		{
			$body.='
		     <div class="about_us_c">
		      <h1>'.$params->get('title_about').'</h1>
		      <div class="w-about-us">
		       '.$params->get('about').'
		      </div>
		     </div>
		     ';
		}


		if($params->get('show_countdown')==1)
		{
			$body.='
		      <div class="about_us_c pad_bot">
		        <h1>'.$params->get('title_countdown').'</h1>
		        <p class="countdown">
		        '.$params->get('desc_countdown').' <span id="defaultCountdown"></span>
		        </p>
              </div>
              ';
        }



		if($params->get('show_endtext')==1){

			switch ($params->get('show_animate')) {
				

				case '1':
					# code...
				$body.='
		       <div class="about_us_c sep">
			       <div class="animated infinite flash">
			        '.$params->get('texte_fin').'
			        </div>
		        </div>';
					break;

				case '2':
					# code...
				$body.='
		       <div class="about_us_c sep">
			       <div class="animated infinite bounceIn">
			        '.$params->get('texte_fin').'
			        </div>
		        </div>';
					break;

				case '3':
					# code...
				$body.='
		       <div class="about_us_c sep">
			       <div class="animated infinite bounce">
			        '.$params->get('texte_fin').'
			        </div>
		        </div>';
					break;

				case '4':
					# code...
				$body.='
		       <div class="about_us_c sep">
			       <div class="animated infinite pulse">
			        '.$params->get('texte_fin').'
			        </div>
		        </div>';
					break;

				case '5':
					# code...
				$body.='
		       <div class="about_us_c sep">
			       <div class="animated infinite rubberband">
			        '.$params->get('texte_fin').'
			        </div>
		        </div>';
					break;


					

					
				
				default:
					# code...
				$body.='
		      <div class="about_us_c sep">
	        	'.$params->get('texte_fin').'
		      </div>';
					break;
			};

			/** if($params->get('show_animate')==1){
				$body.='
		       <div class="about_us_c sep">
			       <div class="animated infinite flash">
			        '.$params->get('texte_fin').'
			        </div>
		        </div>';
		    }
			else 
			{
				$body.='
		      <div class="about_us_c sep">
	        	'.$params->get('texte_fin').'
		      </div>';
		  	} 
		  	**/
		  };
		      
		$body.='</div></div><div>';

	if($params->get('connexion')==1)
	{

		$body.='
		<div class="gear"><div class="verticaltext ">'.$params->get('title_cnx').'</div></div>
		<div class="cont_block_login">
		<div class="block-login">
		<div class="close-block-login"></div>
		<form action="'.JRoute::_('index.php', true).'" method="post" id="form-login">
	
		<p id="form-login-username">
			<label for="username">'.JText::_('JGLOBAL_USERNAME').'</label>
			<input name="username" id="username" type="text" class="inputbox" alt="" size="18" />
		</p>
		<p id="form-login-password">
			<label for="passwd">'.JText::_('JGLOBAL_PASSWORD').'</label>
			<input type="password" name="password" class="inputbox" size="18" alt="" id="passwd" />
		</p>
		
		<input type="submit" name="Submit" class="button" value="'.JText::_('JLOGIN').'" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="'.base64_encode(JURI::base()).'" />
		'.JHtml::_("form.token").'

	    </form>
	    </div>
	    </div>
	    <script>
	      jQuery(".gear").click(function () {
            jQuery(".gear .verticaltext").hide(100);
            jQuery(".cont_block_login").animate({left: "-2px"}, 500);
          });
          jQuery(".close-block-login").click(function () {
            
            jQuery(".cont_block_login").animate({left: "-312px"}, 500);
            jQuery(".gear .verticaltext").show(600);
          });        
	    </script>

	    ';
	}
        
	}		


        $output =$head.$body;

        
        
        JResponse::setBody($output);

        return;
         
        }
     }
  
       

      
   }
	
}