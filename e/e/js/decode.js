<!-- Begin
  var quoteStr;
  var quoteNum;
  var quoteDis;
  var quoteLen;
  var quoteLoc;
  var quotePic;
  var quoteMax;
  var numQuote;

  function funcQuote() {
   this[0] = "Insanity is what you make of it.";
   this[1] = "It's easy to mistake a short term memory for a clear conscience.";
   this[2] = "REAL friends help move bodies.";
   this[3] = "Thinking about things, so you don't have to.	";
   this[4] = "Another goal in my life:  to become a gargantuan, worldeating, mutant alien hive.";
   this[5] = "Memory is necessary for lies.";
   this[6] = "Unique, just like everyone else.";
   this[7] = "Existence if futile.  Deny it.";
   this[8] = "OOPS! My brain just hit a bad sector.";
   this[9] = "90% of all statistics are made up.";
   this[10] = "Warning: Dates in calendar are closer than they appear.";
   this[11] = "Don't take it too seriously, you won't get out alive.";
   this[12] = "Broken glass under my eyelids.";
   this[13] = "Testing for reality...";
   this[14] = "Few women admit their age. Few men act theirs.";
   this[15] = "Give me ambiguity or give me something else.";
   this[16] = "C program run. C program crash. C programmer quit.";
   this[17] = "Did anyone see my lost carrier?";
   this[18] = "I used to have a handle on life.  Then it broke.";
   this[19] = "Beam me aboard, Scotty.....Sure,... will a 2x4 do?";
   this[20] = "Double your drive space - delete windows.";
   this[21] = "A little work, a little sleep, a little love and it's all over.";
   this[22] = "Artificial intelligence usually beats real stupidity.";
   this[23] = "Change is unevitable, except from a vending machine.";
   this[24] = "I.R.S.: We've got what it takes to take what you've got.";
   this[25] = "I don't suffer from insanity. I enjoy every minute of it.";
   this[26] = "Energizer Bunny Arrested!  Charged with battery.";
   this[27] = "The gene pool could use a little chlorine.";
   this[28] = "We are born naked, wet, and hungry. Then things get worse.";
  }
  function getQuote() {
   quoteLen = 0;
   quoteLoc = 0;
   quoteNum = Math.floor(Math.random() * numQuote);
   quoteStr = makeQuote[quoteNum];
   quoteLen = quoteStr.length;
   padQuote();
  }

  function disQuote() {
   quoteLoc = quoteLoc + 1;
   if (quoteLoc > quoteMax) {
    getQuote();
   }
   quoteDis = quoteStr.substring(0, quoteLoc);
   for (var i = quoteLoc; i < quoteMax; i++){
    var charone;
    charone = quoteStr.substring(i, i + 1);
    var rdnum;
    rdnum = Math.floor(Math.random() * 57)
    if (charone != " "){
     quoteDis = "" + quoteDis + quotePic.substring(rdnum, rdnum + 1);
    } else {
     quoteDis = "" + quoteDis + " ";
    }
   }
  }
  function padQuote () {
   var spacePad = quoteMax - quoteStr.length;
   var frontPad = Math.floor(spacePad / 2);
   for (var i = 0; i < frontPad; i++) {
    quoteStr = " " + quoteStr;
   }
   for (var i = quoteStr.length; i < quoteMax; i++) {
    quoteStr= "" + quoteStr + " ";
   }
  }
  function loopQuote() {
   document.RandomText.box1.value=quoteDis;
   disQuote();
   setTimeout ("loopQuote();", 1);
  }
  function startQuote() {
   quoteStr = "";
   quoteNum = 0;
   quoteDis = "";
   quoteLen = 0;
   quoteLoc = 0;
   quotePic = "abcdefghjkmnopqrstuvwxyzABCEDEFGHJKLMNOPQRSTUVXYZ234567890";
   quoteMax = 70;
   numQuote = 29;
   makeQuote = new funcQuote();
   getQuote();
   disQuote();
   loopQuote();
  }
//-->