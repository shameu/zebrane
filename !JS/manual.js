window.<zmienna> - dostęp do zmiennej globalnej
document.<zmienna> - z HTML

var href = window.location;

if(confirm("Wyskakujące powiadomienie OK | Anuluj") == true)
{
	// alert('tak');
	location = "http://www.google.pl";
}

//-----------------------------------

alert("tekst");
alert('tekst');

zmienna = 3.14;
var zmienna = "asd" + 1;
var helloWorld = "Hello" + " World";

parseInt()
parseFloat()

console.log();
document.write();
document.write(parseInt("10") + "<br />");

//----------------------------------------------------------------
// FUNCTIONS
//----------------------------------------------------------------

// imidiatly invoked function - anonymous function - sama się wykonuje:
(function(){}());
// lub :
(function(){})();

// teraz do funkcji można jedynie odwoływać się suma(1,2);
var suma = function sum(paramOne, paramTwo) {
	return paramOne + paramTwo;
}

var roznica = function(paramOne, paramTwo) {
	return paramOne - paramTwo;
}

//-----------------------------------

var number = 9;
var str = num.toString();

var obj = "This is a string object!";

var length = obj.length;

var index = obj.indexOf("T"); 		// 0
var index = obj.indexOf("is"); 		// 2
var index = obj.indexOf("is", 3); 	// 5 - druga wartość: od którego znaku ma startować
var index = obj.indexOf("asd");		// -1 - nie ma takiego wyrazu

var index2 = obj.lastIndexOf("is"); // 5

var objSubstring = obj.substring(5, 5+11); // is a string

var obj2 = obj.replace("string", "STRING"); //This is a STRING object!

var lower = obj2.toLowerCase();
var upper = obj2.toUpperCase();

//-----------------------------------

var type = (typeof 1); // number

//----------------------------------------------------------------
// OBJECTS
//----------------------------------------------------------------

// Object, Array, String, Number, Boolean
var obj = new Object();
var str = new String("tekst");

//-----------------------------------
// stara metoda
//-----------------------------------

var person = new Object();
person.firstName = "Bartek";
person.lastName = "Szypula";
person.getFullName = function() { // tworzenie metody
	// return person.firstName + " " + person.lastName;
	return this.firstName + " " + this.lastName;
}; // średnik musi być

document.write(person.getFullName());

//-----------------------------------
// nowa metoda
//-----------------------------------

var person = {
	firstName : "Jeremy",
	lastName : "Clarkson",
	getFullName : function() {
		return this.firstName + " " + this.lastName;
	}
};

document.write(person.getFullName());

//----------------------------------------------------------------
// ARRAYS
//----------------------------------------------------------------

//-----------------------------------
// stara metoda
//-----------------------------------

var arrayOld = new Array(11, 'drugiElement', true);
// document.write(arrayOld); 		// 11,drugiElement,true
// document.write(arrayOld[1]); 	// drugiElement

//-----------------------------------
// nowa metoda
//-----------------------------------

var arrayNew = ['raz', 'dwa', 'trzy'];
// document.write(arrayNew[0]);

//-----------------------------------

// ilość el. tablicy
var count = arrayNew.length; 	
// nadpisywanie wartości
arrayNew[2] = 3;				//raz,dwa,3

// dodawanie el.
arrayNew.push('cztery');
arrayNew[arrayNew.length] = 5;
arrayNew[5] = 'cześć';

// łączenie tabel
var names1 = ['Adam', 'Tomek'],
	names2 = ['Bartek', 'Karol'];

var people = names1.concat(names2);

// implode - tablica do stringa
var joined = people.join(" : "); // implode

// odwracanie el.
var reverse = people.reverse();

// sortowanie el.
var sorted = people.sort();

//-----------------------------------
// CONDITIONALS
//-----------------------------------

var foo = "6" == 6; // TRUE
var foo = "6" === 6; // FALSE
var foo = "The" == "the"; // FALSE

if( (5 > 6) || (1 > 2) ) {
	document.write(1);
} else if( 1 === "1" ) {
	document.write(2);
} else {
	document.write(3);
}

// if(0) - false, reszta true
// if("") - false
// if("a") - true
// if({}) - true
// if([]) - true
// var foo; //undefined
// if(foo) - false

//-----------------------------------
// LOOPS
//-----------------------------------

for(var i = 0; i < 3 ; i++)
{
	// alert(i);
}

var names = ["Jeremy", "Mateusz", "Tom"];

// for(var i = 0; i < names.length; i++) //ew.:
for(var i = 0, len = names.length; i < len; i++)
{
	// alert(names[i]);
}

var i = 0;
while(i < 3)
{
	// alert(i);
	i++;
}

var i = 0;
do
{
	alert(i);
	i++;
} while(i < 3);

//----------------------------------------------------------------
// DOM
//----------------------------------------------------------------

//-----------------------------------
// stara metoda
//-----------------------------------

	var pElements1 	 	= document.getElementsByTagName("p"); 	// object NodeList - można .length

	var lastPElement1 	= pElements1[pElements1.length - 1]; 	// dostęp do ostatniego el. NodeList - <p id="pId">
	// to samo:
	var pById			= document.getElementById("pId");		// <p id="pId">
	document.write(pById.parentNode.tagName); 					// DIV

	var divById1  	 	= document.getElementById("divID");		// object HTMLDivElement
	document.write(divById1.parentNode.tagName); 				// BODY - 

	// dostęp do tagu elementu rodzica
	XXX.parentNode.tagName

//-----------------------------------
// nowa metoda (CSS?)
//-----------------------------------

// getElementById jest szybsze od querySelector

	var pElements2 	  = document.querySelector("p");		// object HTMLParagraphElement
	var divById2	  = document.querySelector("#divID"); 	// object HTMLDivElement
	var pElementInDiv = document.querySelectorAll("div p"); // object NodeList

//----------------------------------------------------------------
// CREATING ELEMENTS AND ATTRIBUTES
//----------------------------------------------------------------

//-----------------------------------
// dodawanie el. <p> na koniec
//-----------------------------------

	// # 1
	var pElements = document.getElementsByTagName("p"); // zwraca Live List - zmienna zmienia wartość przy zmianach
	// console.log(pElements); // wyświetli zwrócone el. i mni. pole length, które możemy wykorzystać
	// var pElements = document.querySelector("p");		// nie zwraca Live List i length

	console.log(pElements.length); // sprawdzamy ile jest już el. <p> - 5

	// # 2 - tworzymy nowy el.
	var el = document.createElement("p");
	document.body.appendChild(el); // dodaje na koniec

	console.log(pElements.length); // 6

//-----------------------------------
// tworzenie el. <p> v.2
// zmiana atrybutów - np. id 
// dodawanie el. <p>
// nadpisywanie elementów
//-----------------------------------,

	var doc = document; // lepiej stosować dalej "doc", niż "document" - bo JS nie szuka za kazdym razem document, tylko raz

	el = doc.createElement('p');
	// var content = doc.createTextNode("<strong>To było utworzone prze JS</strong>");
	// el.appendChild(content); // content jest w postaci tekstu, a nie HTML!, jeśli HTML chcemy:
	el.innerHTML = "<strong>To było utworzone prze JS</strong>";
	// el.setAttribute("align", "center"); // el.setAttribute("id", "bar")..
	// lepiej tak:
	el.id = "bar";

	// doc.body.appendChild(el); // dodaje el. na koncu

	var pId = doc.getElementById("pId");
	// pId.appendChild(el);
	// pId.parentNode.appendChild(el); // dodaje el. po <p id="pId">
	pId.parentNode.insertBefore(el, pId); // dodaje el. przed <p id="pId">
	// pId.parentNode.replaceChild(el, pId); // zastępuje <p id="pId"> stworzonym przez nas <p id="bar"><strong> etc.

//-----------------------------------
// dostęp do zawartości el.
//-----------------------------------

	el.innerHTML = el.innerHTML + "<br />MODIFIED!"

//----------------------------------------------------------------
// MODYFYING ELEMENTS
//----------------------------------------------------------------

	var divFoo = document.getElementById('foo');

//-----------------------------------
// wersja 1
//-----------------------------------

	// divFoo.style.color = 'blue';
	// divFoo.style.border = '1px solid black';
	// divFoo.style.backgroundColor = 'yellow';
	// alert(divFoo.style.color); // undefined - wyświetli tylko jeśli jest wpisany od razu w pliku html np. "style="color:pink;"

//-----------------------------------
// wersja 2
//-----------------------------------

	// divFoo.className = 'css-class css-class2';
	// divFoo.className = ''; // usuwanie css

	//-----------------------------------
	// classList: - Działa na nowych poza Internet Explorerem
	// divFoo.classList.add("css-class");

	// divFoo.className = "css-class css-class2";
	// divFoo.classList.remove("css-class");
	// divFoo.classList.toggle("css-class"); // zmienia, bądz dodaje w zaleznosci czy jest czy nie 

//-----------------------------------
// get style - wersja 1
//-----------------------------------

	// var color = window.getComputedStyle(divFoo, null).getPropertyValue("color"); // nie potrzeba window., ale tak sie pisze nie wiadomo czemu
	// alert(color);

//-----------------------------------
// get style - wersja 2
//-----------------------------------

	// var color = divFoo.currentStyle["color"];
	// alert(color);

//-----------------------------------
// get style - wersja 3
//-----------------------------------

	var getStyle = function(el, cssProperty) {
		if(typeof getComputedStyle !== "undefined") {
			return window.getComputedStyle(el, null).getPropertyValue(cssProperty);
		} else {
			return el.currentStyle[cssProperty];
		}
	};

	var color = getStyle(divFoo, "color");

//----------------------------------------------------------------
// 
//----------------------------------------------------------------