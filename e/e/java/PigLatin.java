/*
	Ro Ronalds
	Piglatintranslator project
	CompSci 119
*/

import PigLatinTranslator;
import cs1.Keyboard;

public class PigLatin
{
public static void main(String args[]) 
{
String sentence, another;
String result = " ";
//PigLatinTranslator.translate (sentence);
//PigLatinTranslator translator = new PigLatinTranslator();
//sentence = new PigLatinTranslator.translate ()

do
	{
	System.out.println();
	System.out.println("Enter a sentence (without any punctuation):");
	sentence = Keyboard.readString();
	sentence = PigLatinTranslator.translate (sentence);
//	PigLatinTranslator.translate (sentence);
	System.out.println ();
//	result = translator.translate (sentence);
	System.out.println("That sentence in Pig Latin is:");
	System.out.println(sentence);
	System.out.println();
	System.out.print("Translate another sentence (y/n)?");
	sentence = Keyboard.readString();
	sentence = PigLatinTranslator.translate (sentence);
	}
while (sentence.equalsIgnoreCase("y"));
}
}
