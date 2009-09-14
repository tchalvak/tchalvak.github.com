<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="verify-v1" content="N8DvvCP0FrDNUAKQmTxzMAdV8u401v2TGCevn7tTz7g=" />
    <title> Tangent Parados</title>
    <link rel="openid.server" href="http://www.myopenid.com/server">
    <link rel="openid.delegate" href="http://tchalvak.myopenid.com/">
    <link rel="SHORTCUT ICON" href="./favicon.ico"></link>
    <link rel="stylesheet" href="./e/css/css.css" type="text/css"></link>
    <!-- THIS PAGE WITHIN NXS.VZE.COM PARAMETERS.  -->  <!-- Best viewed with: IE, CSS, and westminster font. -->
    <script language="javascript" type="text/javascript" src="js/debug.js"></script>
    <script language="javascript" type="text/javascript">
      <!--
      //function sf(){document.f.q.focus();}
      //var address;
      //function loadwindow()
      //{window.open("http://nxs.vze.com","","width=800,height=500,status=1");}
      -->
    </script>
    <style type="text/css"><!-- a {text-decoration:none;font-weight:bold;font-size:11pt}  --> </style>
    <!--
    //To add to script: function setfocus() {document.formname.elementname.focus();}
    //To add to body: onLoad="setfocus(no idea what goes here)" 
    -->
    
    <style type="text/css">
      * {
        margin: 0;
        padding: 0;
      }

      body {
        /* http://flickr.com/photos/cgstopgo/2199917653/ */
        background: url(./i/creations/digitalcentipede.jpg) repeat;
        height: 1024px;
        color:#cccccc;
        background-color:black;

      }
      
      a{
        color:#00cc00;
      }
      
      a:hover{
      	color:#ff0000;
      }
      
      a:visited{
        color:#999999;
      }
      
      body::first-letter{
        background-color:red;
        color:green;
        }

	ul {
	  list-style-type: none;
	  margin: .5em 0 0 0;
	}
    

    #crazy {
        color:teal;
        background-color:darkred;
    }

      .github a {
        color: maroon;
        background-color:blue;
        padding: .2em;
        font-family: Lucida Grande;
        line-height: 18px;
      }
      
      body>a+img {
        padding: 0;
        background-color:transparent;
      }

      h3 {
        font-family: Lucida Grande;      
      }
      
      #ninja {
        content: "ninjawars";
      }
      
      .github li:before
        {
          content: "Listzors: ";
          font-family: Arial;
          font-size: 1.1em; 
          color: white;  
          background-color: blue;
        } 
        
        .github li::after
        {
          content: " >>>?<<<";
          font-family: Arial;
          font-size: 1.1em;
          color: darkblue;
          background-color: tan;
        } 
        
        
    .github #css-test::first-line{
        color:crimson;
        background-color:purple;
        margin: 3em;
        padding: 2em;
        z-index:50;
    }
    
    .github p+p::first-line, li+li+li+li+li+li::first-line{
        color:crimson;
        background-color:purple;
        margin: 3em;
        padding: 2em;
        z-index:50;
    }
    
    .github p:first-child
    {
      font-size:x-large;
      font-weight:bold;
    } 
    
    .github ul > li:first-child
    {
        font-weight:bold
    } 
    
    .github .blue {
        color:blue;
        background-color:black;
    }
    
 	/* PRE-EXISTING NXS.VZE.COM STYLES */
    
	div.left {
		width:33%;text-align:left:position:relative;float:left;background-image:url('./i/orange-storm-corner.jpg');background-repeat:no-repeat;
	margin-top:6em;
	}
	div.subtitle {
		margin-left:auto;margin-right:auto;width:100%;text-align:center;
	}
	div.core {
		width:33%;text-align:center;position:relative;float:left;background-image:url('./i/orange-storm-corner.jpg');background-repeat:no-repeat;
	}
	div.right {
		position:relative;width:33%;text-align:right;float:left;background-image:url('./i/orange-storm-corner.jpg');background-repeat:no-repeat;
	}
	div.bottom {
		margin-left:auto;margin-right:auto;width:100%;text-align:center
	}

	div.github {
		width: 100%;
		clear:both;
		margin: 3em 0 0 1em;
	}
      
      
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      function repositoryLoad() {
        var limit = 20        // how many repos to list
        var login = 'tchalvak' // your username

        $.getJSON('http://github.com/api/v1/json/' + login + '?callback=?', function(data) {
          var repos = $.grep(data.user.repositories, function() {
            return !this.fork
          })
          


          repos.sort(function(a, b) {
            return b.watchers - a.watchers
          })

          $.each(repos.slice(0, limit), function() {
            $('#repos').append('<li><a href="' + this.url + '">' + this.name + '</a></li>')
          })
        })

		$("#waiting").hide(); // Hide the not yet loaded message.
		
		
      } // End of repositoryLoad function.
      
      function loadLastCommitMessage(){
        var login = 'tchalvak' // your username
              
         $.getJSON('http://github.com/api/v1/json/' + login + '/ninjawars/commit/master/?callback=?', function(data) {
            var unknown = $.grep(data.commit, function() {
                return true;
          })
          /*var_dump(unknown);
          
          var_dump(data);
          var_dump(data.commit);
          var_dump(data.commit.message);
          var_dump(data.commit.url);
          var_dump(data.commit.author.name);
          */
          
              // Load latest commit message.
			$('#latest-commit').html(data.commit.message);
			$('#latest-commit').append("<div id='commit-author'>--"+data.commit.author.name+"</div>");
			$('#latest-commit-title').show();        
			$('#latest-commit').show();
          
          });
          
		}        
      
      
       $(document).ready(function() {
       		$("#repos").append("<div id='waiting'>Repositories not yet loaded.</div>");
           $("#j a").click(function() { // Just for the special jquery testing link.
             alert("Hello world!");
           });
           
           
           
			$('#latest-commit').hide();
			$('#latest-commit-title').hide();
			           
			setTimeout("repositoryLoad()", 5000); // Only load the repositories after a delay.
			
			//$('#latest-commit').load("index.html .subtitle"); //  #commit .message
			//$('#j').load('http://github.com/tchalvak/ninjawars/tree/master #commit');
			//$('#latest-commit').show();
			//$('#latest-commit-title').show();

           			loadLastCommitMessage();
           
         });
    </script>
    
  </head>

  <body id='main-body'>
    <div style="" class="subtitle"> 
      <h3>Reality Biproducts, Version 6.0.0:</h3><!-- Page Update TESTTESTTESTTEST, also get a counter that will input here. -->
      <h4>Thinking about things, so you don't have to.</h4>
      <div id='ignore-me' style='font-size:2em'>Ignore all this, we are transitioning.</div>
    </div>


    <div class="left"><!-- LEFT-->
    <ul>
      <li>
    <a target='_blank' href="http://gmail.google.com/gmail"> Gmail </a>-<a target='_blank' href="http://www.google.com/calendar/render?pli=1">Calendar</a>-<a target='_blank' href="http://www.thesaurus.com">Dicthesaurus</a>-    <a target='_blank' href="http://en.wikipedia.org/wiki/Main_Page">Wikipedia</a>-<a target='_blank' href="http://www.playlist.com">Music</a>
      </li>
      <li>
    <a target='_blank' href='http://www.elfquest.com/gallery/OnlineComics3.html'>Elfquest</a>-<a target='_blank' href="http://www.pagebypagebooks.com">Reading</a>-<a target='_blank' href="http://www.geneseo.edu/~ror1/AGmud.exe">MUD</a>-<a target='_blank' href="http://www.mudconnector.com">Connector</a>-<a target='_blank' href="http://www.facebook.com">Facebook</a>
      </li>
      <li>
      <a target='_blank' href="http://www.girlgeniusonline.com/comic.php">GirlGenius</a>-<a target='_blank' href="http://www.schlockmercenary.com">Schlock</a>-<a target='_blank' href="http://www.crfh.net/">Crfh</a>-<a target='_blank' href="http://qwantz.com">Qwantz</a>-<a target='_blank' href="http://www.asofterworld.com/index.php">Softer</a><br />
      </li>
      <li>
      <a target='_blank' href="http://www.ninjawars.net/webgame/">Ninja</a>-<a target='_blank' href="http://ninjawars.proboards19.com/">Forum</a>-<a target='_blank' href="http://gagg.geneseo.edu/phpBB2/">Gagg</a>-<a target='_blank' href="http://ninjawars.net/~tchalvak/ninjawars/trunk/webgame/index.php">Nwtest</a>-<a target='_blank' href="http://github.com/tchalvak/ninjawars/tree/master">NwGitHub</a><br />
      </li>
     </ul>
    </div>

    <div class="core"><!-- CORE-->
      <div class="title">
        <img src="./i/creations/crystalshattering.gif" alt="" />
      </div>
      <br />
      <div class="orange">
        Shards of:
      </div>
      <a target='_blank' href="./i/i.html">Light</a>-
      <a target='_blank' href="./n/n.html');">Text</a>-
      <a target='_blank' href="./e/e.html">Code</a>-
      <a target='_blank' href="./x/x.html">Internet</a>-
      <a target='_blank' href="http://tchalvak.pbwiki.com">Wiki</a><br />
    </div>


    <div class="right"><!-- RIGHT-->
        <ul>
      <li><a target='_blank' href="./i/creations/">Artwork /Dir</a></li>
      <li><a target='_blank' href="http://dnaexmosn.deviantart.com/">Deviant Art Gallery</a></li>
      <!-- Remember to change the link href, the link text, the image source, and the image dimensions. -->
      <li><a target='_blank' id="latestimage" href="./i/creations/manyeyessmall.gif">Many Eyes, One World
        <img style="border:0" src="./i/creations/manyeyessmall.gif" width="50" height="50" alt="Many eyes" />
      </a></li>
      <li><a class="fade" href="mailto:tchalvakSPAM@gmail.com">tchalvak@</a></li>
      <li><b>AIM: Tchalvak</b></li>
      <li><a target='_blank' href="http://conceptart.org/forums/">Conceptart.org</a></li>
    </div>
    
    

    <div class="bottom"><!-- BOTTOM-->
      <!-- Remember to change the link href, the latest date, and the image source. -->
      <ul>
      <li><a class="fade" href="./i/entities/unknownalienbugs.jpg">Latest Mirrored Image: July 13th, 2005</a></li>
      <!-- Image hidden for now <img src="./i/entities/unknownalienbugs.jpg" alt="mirrored image" /><br /> -->
      <li><a class="fade" href="./i/entities/">Mirror /Dir</a></li>
      <li><a href="http://www.shorturl.com/ref/in.cgi?nxs.vze.com" target="_blank" class="fade">ShortURL.com</a></li>
      <li><a href="http://validator.w3.org/check?uri=referer" target="_blank" class="fade">Check Page Code</a></li>
      <ul>
      
      <div>
      	<a href='http://github.com/tchalvak'>github.com/tchalvak</a>
      </div>
    <ul id="repos"> <!-- GITHUB REPOS -->
      <li><h3>repositories</h3></li>
      <li id='latest-commit-title'>NW latest commit:</li>
      <li id='latest-commit'></li>
    </ul>
    </div>
    
    
    
    <div id='tchalvak github com content' style=''>
    <a href="http://github.com/tchalvak/tchalvak.github.com"><img style="position:absolute; top: 0; left: 0; border: 0;" src="http://s3.amazonaws.com/github/ribbons/forkme_left_gray_6d6d6d.png" alt="Fork me on GitHub" /></a>            
    <div id='css-test'>
    <ul>
      <li id='crazy'><a href="crazyIndex.html">JSified Version of 3n's start page</a><li> 
    </ul>
        Currrazy CSS Testing
        <p>Bugzhunta</p>
        <p>Kzqai</p>
        <p>You probably don't want to fork this on github.</p>
	    <div id='j'>
	        Pile 'o jQuery! <a href=''>jsified link</a>
	    </div>
    </div>
    
    </div> <!-- End of tchalvak.github.com type content -->
  </body>
</html>
