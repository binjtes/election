<?php
namespace BepsElectionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface ;
use Doctrine\Common\Persistence\ObjectManager;
use BepsElectionBundle\Entity\Country;


class LoadCountry extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
  
        

        // if you play twice force reset the ids in mysql ALTER TABLE <tablename> AUTO_INCREMENT = 1;
     
       
        $countries = json_decode($this->getJson()) ;
     
        
        foreach ($countries as $country) {
            $newcountry = new Country();
            $newcountry->setName($country->shortname);
            $newcountry->setFlag($country->drapeau_img);
            $manager->persist($newcountry);
            $old_ref = $country->pays_id ;
            $this->addReference('country'.$old_ref , $newcountry); 
            
        }
        
        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
    
    
    
    public function getJson(){
        return '[
	{
		"pays_id" : 2,
		"shortname" : "Afghanistan",
		"drapeau_img" : "afghanistan.png"
	},
	{
		"pays_id" : 5,
		"shortname" : "Albania",
		"drapeau_img" : "albania.png"
	},
	{
		"pays_id" : 6,
		"shortname" : "Algeria",
		"drapeau_img" : "algeria.png"
	},
	{
		"pays_id" : 7,
		"shortname" : "Andorra",
		"drapeau_img" : "andorra.png"
	},
	{
		"pays_id" : 8,
		"shortname" : "Angola",
		"drapeau_img" : "angola.png"
	},
	{
		"pays_id" : 10,
		"shortname" : "Argentina",
		"drapeau_img" : "argentina.png"
	},
	{
		"pays_id" : 11,
		"shortname" : "Armenia",
		"drapeau_img" : "armenia.png"
	},
	{
		"pays_id" : 13,
		"shortname" : "Australia",
		"drapeau_img" : "australia.png"
	},
	{
		"pays_id" : 14,
		"shortname" : "Austria",
		"drapeau_img" : "osterreich.png"
	},
	{
		"pays_id" : 15,
		"shortname" : "Azerbaijan",
		"drapeau_img" : "azerbaijan.png"
	},
	{
		"pays_id" : 16,
		"shortname" : "Bahamas",
		"drapeau_img" : "bahamas.png"
	},
	{
		"pays_id" : 19,
		"shortname" : "Bangladesh",
		"drapeau_img" : "bangladesh.png"
	},
	{
		"pays_id" : 22,
		"shortname" : "Barbados",
		"drapeau_img" : "barbados.png"
	},
	{
		"pays_id" : 23,
		"shortname" : "Belarus",
		"drapeau_img" : "belarus.png"
	},
	{
		"pays_id" : 24,
		"shortname" : "Belgium",
		"drapeau_img" : "belgium.png"
	},
	{
		"pays_id" : 25,
		"shortname" : "Belize",
		"drapeau_img" : "belize.png"
	},
	{
		"pays_id" : 26,
		"shortname" : "Benin",
		"drapeau_img" : "benin.png"
	},
	{
		"pays_id" : 27,
		"shortname" : "Bermuda",
		"drapeau_img" : "bermuda.png"
	},
	{
		"pays_id" : 29,
		"shortname" : "Bhutan",
		"drapeau_img" : "bhutan.png"
	},
	{
		"pays_id" : 31,
		"shortname" : "Bolivia",
		"drapeau_img" : "bolivia.png"
	},
	{
		"pays_id" : 33,
		"shortname" : "Bosnia and Herzegovina",
		"drapeau_img" : "bosnia-and-herzegovina.png"
	},
	{
		"pays_id" : 34,
		"shortname" : "Botswana",
		"drapeau_img" : "botswana.png"
	},
	{
		"pays_id" : 35,
		"shortname" : "Brazil",
		"drapeau_img" : "brazil.png"
	},
	{
		"pays_id" : 36,
		"shortname" : "Brunei",
		"drapeau_img" : "brunei.png"
	},
	{
		"pays_id" : 38,
		"shortname" : "Bulgaria",
		"drapeau_img" : "bulgaria.png"
	},
	{
		"pays_id" : 39,
		"shortname" : "Burkina Faso",
		"drapeau_img" : "burkinafaso.png"
	},
	{
		"pays_id" : 40,
		"shortname" : "Burundi",
		"drapeau_img" : "burundi.png"
	},
	{
		"pays_id" : 42,
		"shortname" : "Cambodia",
		"drapeau_img" : "cambodia.png"
	},
	{
		"pays_id" : 43,
		"shortname" : "Cameroon",
		"drapeau_img" : "cameroon.png"
	},
	{
		"pays_id" : 44,
		"shortname" : "Canada",
		"drapeau_img" : "canada.png"
	},
	{
		"pays_id" : 46,
		"shortname" : "CapeVerde",
		"drapeau_img" : "capeverde.png"
	},
	{
		"pays_id" : 48,
		"shortname" : "Cayman Islands",
		"drapeau_img" : "caymanislands.png"
	},
	{
		"pays_id" : 49,
		"shortname" : "Central African Republic",
		"drapeau_img" : "centralafricanrepublic.png"
	},
	{
		"pays_id" : 50,
		"shortname" : "Chad",
		"drapeau_img" : "chad.png"
	},
	{
		"pays_id" : 52,
		"shortname" : "Chile",
		"drapeau_img" : "chile.png"
	},
	{
		"pays_id" : 53,
		"shortname" : "Colombia",
		"drapeau_img" : "colombia.png"
	},
	{
		"pays_id" : 54,
		"shortname" : "Comoros",
		"drapeau_img" : "comoros.png"
	},
	{
		"pays_id" : 59,
		"shortname" : "Costa Rica",
		"drapeau_img" : "costarica.png"
	},
	{
		"pays_id" : 62,
		"shortname" : "Croatia",
		"drapeau_img" : "croatia.png"
	},
	{
		"pays_id" : 63,
		"shortname" : "Cuba",
		"drapeau_img" : "cuba.png"
	},
	{
		"pays_id" : 66,
		"shortname" : "Cyprus",
		"drapeau_img" : "cyprus.png"
	},
	{
		"pays_id" : 67,
		"shortname" : "Czech Republic",
		"drapeau_img" : "czech-republic.png"
	},
	{
		"pays_id" : 69,
		"shortname" : "Democratic Republic Of Congo",
		"drapeau_img" : "democratic-republic-of-congo.png"
	},
	{
		"pays_id" : 70,
		"shortname" : "Denmark",
		"drapeau_img" : "denmark.png"
	},
	{
		"pays_id" : 72,
		"shortname" : "Djibouti",
		"drapeau_img" : "djibouti.png"
	},
	{
		"pays_id" : 73,
		"shortname" : "Dominica",
		"drapeau_img" : "dominica.png"
	},
	{
		"pays_id" : 74,
		"shortname" : "Dominican Republic",
		"drapeau_img" : "dominican-republic.png"
	},
	{
		"pays_id" : 81,
		"shortname" : "Egypt",
		"drapeau_img" : "egypt.png"
	},
	{
		"pays_id" : 82,
		"shortname" : "El Salvador",
		"drapeau_img" : "el-salvador.png"
	},
	{
		"pays_id" : 85,
		"shortname" : "Equatorial Guinea",
		"drapeau_img" : "equatorial-guinea.png"
	},
	{
		"pays_id" : 86,
		"shortname" : "Eritrea",
		"drapeau_img" : "eritrea.png"
	},
	{
		"pays_id" : 87,
		"shortname" : "Estonia",
		"drapeau_img" : "estonia.png"
	},
	{
		"pays_id" : 88,
		"shortname" : "Ethiopia",
		"drapeau_img" : "ethiopia.png"
	},
	{
		"pays_id" : 109,
		"shortname" : "Falkland Islands",
		"drapeau_img" : "falkland-islands.png"
	},
	{
		"pays_id" : 110,
		"shortname" : "Faroe Islands",
		"drapeau_img" : "faroe-islands.png"
	},
	{
		"pays_id" : 113,
		"shortname" : "Fiji",
		"drapeau_img" : "fiji.png"
	},
	{
		"pays_id" : 114,
		"shortname" : "Finland",
		"drapeau_img" : "finland.png"
	},
	{
		"pays_id" : 117,
		"shortname" : "France",
		"drapeau_img" : "france.png"
	},
	{
		"pays_id" : 118,
		"shortname" : "French Guiana",
		"drapeau_img" : "french-guiana.png"
	},
	{
		"pays_id" : 119,
		"shortname" : "FrenchPolynesia",
		"drapeau_img" : "frenchpolynesia.png"
	},
	{
		"pays_id" : 122,
		"shortname" : "Gabon",
		"drapeau_img" : "gabon.png"
	},
	{
		"pays_id" : 123,
		"shortname" : "Gambia",
		"drapeau_img" : "gambia.png"
	},
	{
		"pays_id" : 124,
		"shortname" : "Georgia",
		"drapeau_img" : "georgia.png"
	},
	{
		"pays_id" : 125,
		"shortname" : "Deutschland",
		"drapeau_img" : "deutschland.png"
	},
	{
		"pays_id" : 126,
		"shortname" : "Ghana",
		"drapeau_img" : "ghana.png"
	},
	{
		"pays_id" : 128,
		"shortname" : "Greece",
		"drapeau_img" : "greece.png"
	},
	{
		"pays_id" : 130,
		"shortname" : "Grenada",
		"drapeau_img" : "grenada.png"
	},
	{
		"pays_id" : 134,
		"shortname" : "Guatemala",
		"drapeau_img" : "guatemala.png"
	},
	{
		"pays_id" : 135,
		"shortname" : "Guinea",
		"drapeau_img" : "guinea.png"
	},
	{
		"pays_id" : 136,
		"shortname" : "Guinea-Bissau",
		"drapeau_img" : "guinea-bissau.png"
	},
	{
		"pays_id" : 137,
		"shortname" : "Guyana",
		"drapeau_img" : "guyana.png"
	},
	{
		"pays_id" : 138,
		"shortname" : "Haiti",
		"drapeau_img" : "haiti.png"
	},
	{
		"pays_id" : 140,
		"shortname" : "Honduras",
		"drapeau_img" : "honduras.png"
	},
	{
		"pays_id" : 143,
		"shortname" : "Hungary",
		"drapeau_img" : "hungary.png"
	},
	{
		"pays_id" : 145,
		"shortname" : "Iceland",
		"drapeau_img" : "iceland.png"
	},
	{
		"pays_id" : 148,
		"shortname" : "India",
		"drapeau_img" : "india.png"
	},
	{
		"pays_id" : 149,
		"shortname" : "Indonesia",
		"drapeau_img" : "indonesia.png"
	},
	{
		"pays_id" : 153,
		"shortname" : "Iran",
		"drapeau_img" : "iran.png"
	},
	{
		"pays_id" : 154,
		"shortname" : "Iraq",
		"drapeau_img" : "iraq.png"
	},
	{
		"pays_id" : 156,
		"shortname" : "Ireland",
		"drapeau_img" : "ireland.png"
	},
	{
		"pays_id" : 157,
		"shortname" : "Israel",
		"drapeau_img" : "israel.png"
	},
	{
		"pays_id" : 158,
		"shortname" : "Italy",
		"drapeau_img" : "italy.png"
	},
	{
		"pays_id" : 159,
		"shortname" : "Jamaica",
		"drapeau_img" : "jamaica.png"
	},
	{
		"pays_id" : 160,
		"shortname" : "Japan",
		"drapeau_img" : "japan.png"
	},
	{
		"pays_id" : 161,
		"shortname" : "Jordan",
		"drapeau_img" : "jordan.png"
	},
	{
		"pays_id" : 162,
		"shortname" : "Kazakhstan",
		"drapeau_img" : "kazakhstan.png"
	},
	{
		"pays_id" : 163,
		"shortname" : "Kenya",
		"drapeau_img" : "kenya.png"
	},
	{
		"pays_id" : 164,
		"shortname" : "Kiribati",
		"drapeau_img" : "kiribati.png"
	},
	{
		"pays_id" : 165,
		"shortname" : "Kuwait",
		"drapeau_img" : "kuwait.png"
	},
	{
		"pays_id" : 166,
		"shortname" : "Kyrgyzstan",
		"drapeau_img" : "kyrgyzstan.png"
	},
	{
		"pays_id" : 167,
		"shortname" : "Latvia",
		"drapeau_img" : "latvia.png"
	},
	{
		"pays_id" : 168,
		"shortname" : "Lebanon",
		"drapeau_img" : "lebanon.png"
	},
	{
		"pays_id" : 170,
		"shortname" : "Lesotho",
		"drapeau_img" : "lesotho.png"
	},
	{
		"pays_id" : 171,
		"shortname" : "Liberia",
		"drapeau_img" : "liberia.png"
	},
	{
		"pays_id" : 172,
		"shortname" : "Libya",
		"drapeau_img" : "libya.png"
	},
	{
		"pays_id" : 173,
		"shortname" : "Liechtenstein",
		"drapeau_img" : "liechtenstein.png"
	},
	{
		"pays_id" : 174,
		"shortname" : "Lithuania",
		"drapeau_img" : "lithuania.png"
	},
	{
		"pays_id" : 175,
		"shortname" : "Luxembourg",
		"drapeau_img" : "luxembourg.png"
	},
	{
		"pays_id" : 177,
		"shortname" : "Madagascar",
		"drapeau_img" : "madagascar.png"
	},
	{
		"pays_id" : 178,
		"shortname" : "Malawi",
		"drapeau_img" : "malawi.png"
	},
	{
		"pays_id" : 179,
		"shortname" : "Malaysia",
		"drapeau_img" : "malaysia.png"
	},
	{
		"pays_id" : 180,
		"shortname" : "Maldives",
		"drapeau_img" : "maldives.png"
	},
	{
		"pays_id" : 181,
		"shortname" : "Mali",
		"drapeau_img" : "mali.png"
	},
	{
		"pays_id" : 182,
		"shortname" : "Malta",
		"drapeau_img" : "malta.png"
	},
	{
		"pays_id" : 184,
		"shortname" : "Marshall Islands",
		"drapeau_img" : "marshallislands.png"
	},
	{
		"pays_id" : 186,
		"shortname" : "Mauritania",
		"drapeau_img" : "mauritania.png"
	},
	{
		"pays_id" : 187,
		"shortname" : "Mauritius",
		"drapeau_img" : "mauritius.png"
	},
	{
		"pays_id" : 189,
		"shortname" : "Mexico",
		"drapeau_img" : "mexico.png"
	},
	{
		"pays_id" : 190,
		"shortname" : "Micronesia",
		"drapeau_img" : "micronesia.png"
	},
	{
		"pays_id" : 196,
		"shortname" : "Moldova",
		"drapeau_img" : "moldova.png"
	},
	{
		"pays_id" : 197,
		"shortname" : "Monaco",
		"drapeau_img" : "monaco.png"
	},
	{
		"pays_id" : 199,
		"shortname" : "Mongolia",
		"drapeau_img" : "mongolia.png"
	},
	{
		"pays_id" : 201,
		"shortname" : "Morocco",
		"drapeau_img" : "morocco.png"
	},
	{
		"pays_id" : 202,
		"shortname" : "Mozambique",
		"drapeau_img" : "mozambique.png"
	},
	{
		"pays_id" : 203,
		"shortname" : "Myanmar",
		"drapeau_img" : "myanmar.png"
	},
	{
		"pays_id" : 204,
		"shortname" : "Namibia",
		"drapeau_img" : "namibia.png"
	},
	{
		"pays_id" : 206,
		"shortname" : "Nauru",
		"drapeau_img" : "nauru.png"
	},
	{
		"pays_id" : 207,
		"shortname" : "Nepal",
		"drapeau_img" : "nepal.png"
	},
	{
		"pays_id" : 208,
		"shortname" : "Netherlands",
		"drapeau_img" : "netherlands.png"
	},
	{
		"pays_id" : 210,
		"shortname" : "New Zealand",
		"drapeau_img" : "newzealand.png"
	},
	{
		"pays_id" : 212,
		"shortname" : "Nicaragua",
		"drapeau_img" : "nicaragua.png"
	},
	{
		"pays_id" : 213,
		"shortname" : "Niger",
		"drapeau_img" : "niger.png"
	},
	{
		"pays_id" : 214,
		"shortname" : "Nigeria",
		"drapeau_img" : "nigeria.png"
	},
	{
		"pays_id" : 215,
		"shortname" : "Norway",
		"drapeau_img" : "norway.png"
	},
	{
		"pays_id" : 219,
		"shortname" : "Oman",
		"drapeau_img" : "oman.png"
	},
	{
		"pays_id" : 220,
		"shortname" : "Pakistan",
		"drapeau_img" : "pakistan.png"
	},
	{
		"pays_id" : 221,
		"shortname" : "Palau",
		"drapeau_img" : "palau.png"
	},
	{
		"pays_id" : 223,
		"shortname" : "Panama",
		"drapeau_img" : "panama.png"
	},
	{
		"pays_id" : 224,
		"shortname" : "Papua New Guinea",
		"drapeau_img" : "papuanewguinea.png"
	},
	{
		"pays_id" : 225,
		"shortname" : "Paraguay",
		"drapeau_img" : "paraguay.png"
	},
	{
		"pays_id" : 228,
		"shortname" : "Peru",
		"drapeau_img" : "peru.png"
	},
	{
		"pays_id" : 229,
		"shortname" : "Philippines",
		"drapeau_img" : "philippines.png"
	},
	{
		"pays_id" : 230,
		"shortname" : "Poland",
		"drapeau_img" : "poland.png"
	},
	{
		"pays_id" : 231,
		"shortname" : "Portugal",
		"drapeau_img" : "portugal.png"
	},
	{
		"pays_id" : 233,
		"shortname" : "PuertoRico",
		"drapeau_img" : "puertorico.png"
	},
	{
		"pays_id" : 234,
		"shortname" : "Qatar",
		"drapeau_img" : "qatar.png"
	},
	{
		"pays_id" : 236,
		"shortname" : "Congo",
		"drapeau_img" : "congo.png"
	},
	{
		"pays_id" : 238,
		"shortname" : "Romania",
		"drapeau_img" : "romania.png"
	},
	{
		"pays_id" : 239,
		"shortname" : "Russia",
		"drapeau_img" : "russia.png"
	},
	{
		"pays_id" : 240,
		"shortname" : "Rwanda",
		"drapeau_img" : "rwanda.png"
	},
	{
		"pays_id" : 241,
		"shortname" : "Samoa",
		"drapeau_img" : "samoa.png"
	},
	{
		"pays_id" : 242,
		"shortname" : "SanMarino",
		"drapeau_img" : "sanmarino.png"
	},
	{
		"pays_id" : 243,
		"shortname" : "Saudi Arabia",
		"drapeau_img" : "saudiarabia.png"
	},
	{
		"pays_id" : 245,
		"shortname" : "Senegal",
		"drapeau_img" : "senegal.png"
	},
	{
		"pays_id" : 246,
		"shortname" : "Serbia",
		"drapeau_img" : "serbia.png"
	},
	{
		"pays_id" : 248,
		"shortname" : "Seychelles",
		"drapeau_img" : "seychelles.png"
	},
	{
		"pays_id" : 250,
		"shortname" : "Sierra Leone",
		"drapeau_img" : "sierraleone.png"
	},
	{
		"pays_id" : 251,
		"shortname" : "Singapore",
		"drapeau_img" : "singapore.png"
	},
	{
		"pays_id" : 252,
		"shortname" : "Slovakia",
		"drapeau_img" : "slovakia.png"
	},
	{
		"pays_id" : 253,
		"shortname" : "Slovenia",
		"drapeau_img" : "slovenia.png"
	},
	{
		"pays_id" : 256,
		"shortname" : "Somalia",
		"drapeau_img" : "somalia.png"
	},
	{
		"pays_id" : 257,
		"shortname" : "SouthAfrica",
		"drapeau_img" : "southafrica.png"
	},
	{
		"pays_id" : 258,
		"shortname" : "Skorea",
		"drapeau_img" : "skorea.png"
	},
	{
		"pays_id" : 261,
		"shortname" : "SriLanka",
		"drapeau_img" : "srilanka.png"
	},
	{
		"pays_id" : 263,
		"shortname" : "Sudan",
		"drapeau_img" : "sudan.png"
	},
	{
		"pays_id" : 264,
		"shortname" : "Suriname",
		"drapeau_img" : "suriname.png"
	},
	{
		"pays_id" : 265,
		"shortname" : "Swaziland",
		"drapeau_img" : "swaziland.png"
	},
	{
		"pays_id" : 266,
		"shortname" : "Sweden",
		"drapeau_img" : "sweden.png"
	},
	{
		"pays_id" : 267,
		"shortname" : "Switzerland",
		"drapeau_img" : "switzerland.png"
	},
	{
		"pays_id" : 268,
		"shortname" : "Syria",
		"drapeau_img" : "syria.png"
	},
	{
		"pays_id" : 269,
		"shortname" : "Taiwan",
		"drapeau_img" : "taiwan.png"
	},
	{
		"pays_id" : 270,
		"shortname" : "Tajikistan",
		"drapeau_img" : "tajikistan.png"
	},
	{
		"pays_id" : 271,
		"shortname" : "Tanzania",
		"drapeau_img" : "tanzania.png"
	},
	{
		"pays_id" : 276,
		"shortname" : "Thailand",
		"drapeau_img" : "thailand.png"
	},
	{
		"pays_id" : 277,
		"shortname" : "Timor-Leste",
		"drapeau_img" : "timor-leste.png"
	},
	{
		"pays_id" : 278,
		"shortname" : "Togo",
		"drapeau_img" : "togo.png"
	},
	{
		"pays_id" : 279,
		"shortname" : "Tonga",
		"drapeau_img" : "tonga.png"
	},
	{
		"pays_id" : 282,
		"shortname" : "TrinidadandTobago",
		"drapeau_img" : "trinidadandtobago.png"
	},
	{
		"pays_id" : 283,
		"shortname" : "Tunisia",
		"drapeau_img" : "tunisia.png"
	},
	{
		"pays_id" : 284,
		"shortname" : "Turkey",
		"drapeau_img" : "turkey.png"
	},
	{
		"pays_id" : 285,
		"shortname" : "Turkmenistan",
		"drapeau_img" : "turkmenistan.png"
	},
	{
		"pays_id" : 286,
		"shortname" : "Tuvalu",
		"drapeau_img" : "tuvalu.png"
	},
	{
		"pays_id" : 287,
		"shortname" : "Uganda",
		"drapeau_img" : "uganda.png"
	},
	{
		"pays_id" : 288,
		"shortname" : "Ukraine",
		"drapeau_img" : "ukraine.png"
	},
	{
		"pays_id" : 290,
		"shortname" : "United Arab Emirates",
		"drapeau_img" : "unitedarabemirates.png"
	},
	{
		"pays_id" : 291,
		"shortname" : "UK",
		"drapeau_img" : "uk.png"
	},
	{
		"pays_id" : 293,
		"shortname" : "Uruguay",
		"drapeau_img" : "uruguay.png"
	},
	{
		"pays_id" : 295,
		"shortname" : "Uzbekistan",
		"drapeau_img" : "uzbekistan.png"
	},
	{
		"pays_id" : 296,
		"shortname" : "Vanuatu",
		"drapeau_img" : "vanuatu.png"
	},
	{
		"pays_id" : 297,
		"shortname" : "Vatican",
		"drapeau_img" : "vatican.png"
	},
	{
		"pays_id" : 298,
		"shortname" : "Venezuela",
		"drapeau_img" : "venezuela.png"
	},
	{
		"pays_id" : 299,
		"shortname" : "VietNam",
		"drapeau_img" : "vietnam.png"
	},
	{
		"pays_id" : 302,
		"shortname" : "Western Sahara",
		"drapeau_img" : "westernsahara.png"
	},
	{
		"pays_id" : 304,
		"shortname" : "Yemen",
		"drapeau_img" : "yemen.png"
	},
	{
		"pays_id" : 305,
		"shortname" : "Zambia",
		"drapeau_img" : "zambia.png"
	},
	{
		"pays_id" : 306,
		"shortname" : "Zimbabwe",
		"drapeau_img" : "zimbabwe.png"
	},
	{
		"pays_id" : 311,
		"shortname" : "China",
		"drapeau_img" : "china.png"
	},
	{
		"pays_id" : 318,
		"shortname" : "westbank",
		"drapeau_img" : "westbank.png"
	},
	{
		"pays_id" : 342,
		"shortname" : "ivory",
		"drapeau_img" : "ivory.png"
	},
	{
		"pays_id" : 344,
		"shortname" : "Gaza",
		"drapeau_img" : "gaza.png"
	},
	{
		"pays_id" : 350,
		"shortname" : "chechnya",
		"drapeau_img" : "chechnya.png"
	},
	{
		"pays_id" : 354,
		"shortname" : "RD Congo",
		"drapeau_img" : "rdcongo.png"
	},
	{
		"pays_id" : 355,
		"shortname" : "Bahrain",
		"drapeau_img" : "bahrain.png"
	},
	{
		"pays_id" : 359,
		"shortname" : "Dagestan",
		"drapeau_img" : "dagestan.png"
	},
	{
		"pays_id" : 360,
		"shortname" : "Montenegro",
		"drapeau_img" : "montenegro.png"
	},
	{
		"pays_id" : 366,
		"shortname" : "nkorea",
		"drapeau_img" : "nkorea.png"
	},
	{
		"pays_id" : 367,
		"shortname" : "Macedonia",
		"drapeau_img" : "macedonia.png"
	},
	{
		"pays_id" : 393,
		"shortname" : "Korea",
		"drapeau_img" : "korea.png"
	},
	{
		"pays_id" : 399,
		"shortname" : "VIETNA",
		"drapeau_img" : "vietna.png"
	},
	{
		"pays_id" : 402,
		"shortname" : "WESTBANK",
		"drapeau_img" : "westbank.png"
	},
	{
		"pays_id" : 403,
		"shortname" : "YOKOHA",
		"drapeau_img" : "yokoha.png"
	},
	{
		"pays_id" : 423,
		"shortname" : "ROMANI",
		"drapeau_img" : "romani.png"
	},
	{
		"pays_id" : 426,
		"shortname" : "SANTIA",
		"drapeau_img" : "santia.png"
	},
	{
		"pays_id" : 432,
		"shortname" : "Somalia",
		"drapeau_img" : "somalia.png"
	},
	{
		"pays_id" : 435,
		"shortname" : "Spain",
		"drapeau_img" : "spain.png"
	},
	{
		"pays_id" : 447,
		"shortname" : "USA",
		"drapeau_img" : "usa.png"
	},
	{
		"pays_id" : 450,
		"shortname" : "VENEZUELA",
		"drapeau_img" : "venezuela.png"
	},
	{
		"pays_id" : 472,
		"shortname" : "KAZAKH",
		"drapeau_img" : "kazakh.png"
	},
	{
		"pays_id" : 528,
		"shortname" : "DARFUR",
		"drapeau_img" : "darfur.png"
	},
	{
		"pays_id" : 564,
		"shortname" : "REPDOM",
		"drapeau_img" : "repdom.png"
	},
	{
		"pays_id" : 4126,
		"shortname" : "Ecuador",
		"drapeau_img" : "ecuador.png"
	},
	{
		"pays_id" : 4127,
		"shortname" : "Laos",
		"drapeau_img" : "laos.png"
	},
	{
		"pays_id" : 4131,
		"shortname" : "Sao Tome and Principe",
		"drapeau_img" : "saotomeandprincipe.png"
	},
	{
		"pays_id" : 4345,
		"shortname" : "Abkhazia",
		"drapeau_img" : "abkhazia.png"
	},
	{
		"pays_id" : 105,
		"shortname" : "European Union",
		"drapeau_img" : "europeanunion.png"
	}
] ';
    }
    
    
}