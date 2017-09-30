/*****************************************************************************
 *  FILE:  anytimetz.js - The Any+Time JavaScript Library
 *                        Basic Time Zone Support (source)
 *
 *  VERSION: 5.2.0
 *
 *  Copyright Andrew M. Andrews III and other contributors. This software
 *  may consist of voluntary contributions made by many individuals.
 *
 *  The following license applies to all parts of this software:
 *
 *  Permission is hereby granted, free of charge, to any person obtaining
 *  a copy of this software and associated documentation files (the
 *  "Software"), to deal in the Software without restriction, including
 *  without limitation the rights to use, copy, modify, merge, publish,
 *  distribute, sublicense, and/or sell copies of the Software, and to
 *  permit persons to whom the Software is furnished to do so, subject to
 *  the following conditions:
 *
 *  The above copyright notice and this permission notice shall be
 *  included in all copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 *  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 *  LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *  OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *  WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 ****************************************************************************/

/*****************************************************************************
 *  This file adds basic labels for major time zones to the Any+Time(TM)
 *  JavaScript Library.  Time zone support is extremely complicated, and
 *  ECMA-262 (JavaScript) provides little support.  Developers are expected
 *  to tailor this file to meet their needs, mostly by removing lines that
 *  are not required by their users, and/or by removing either abbreviated
 *  (before double-dash) or long (after double-dash) names from the strings.
 *
 *  Note that there is no automatic detection of daylight savings time
 *  (AKA summer time), due to lack of support in JavaScript and the
 *  time-prohibitive complexity of attempting such support in code.
 *  If you want to take a stab at it, let me know; if you want to pay me
 *  large sums of money to add it, again, let me know. :-p
 *
 *  This file should be included AFTER anytime.js in any HTML page that
 *  requires it.
 ****************************************************************************/

//=============================================================================
//  AnyTime.utcLabel is an array of arrays, indexed by UTC offset IN MINUTES
//  (not hours-and-minutes).  This is used by AnyTime.Converter to display
//  time zone labels when the "%@" format specifier is used.  It is also used
//  by AnyTime.widget() to determine which time zone labels to offer as valid
//  choices when a user attempts to change the time zone.  NOTE: Positive
//  indicies are NOT signed.
//
//  Each sub-array contains a series of strings, each of which is a label
//  for a time-zone having the corresponding UTC offset.  The first string in
//  each sub-array is the default label for that UTC offset (the one used by
//  AnyTime.Converter.format() if utcFormatOffsetSubIndex is not specified and
//  setUtcFormatOffsetSubIndex() is not called.
//
//  To overcome a bug in Firefox 21 IRT negative array indicies, the initial
//  utcLabel must be defined as an object even though it is used as an array.
//=============================================================================

AnyTime.utcLabel = {};
AnyTime.utcLabel[-720]=[
  'BIT--Baker Island Time'
  ];
AnyTime.utcLabel[-660]=[
  'SST--Samoa Standard Time'
  ];
AnyTime.utcLabel[-600]=[
  'CKT--Cook Island Time'
  ,'HAST--Hawaii-Aleutian Standard Time'
  ,'TAHT--Tahiti Time'
  ];
AnyTime.utcLabel[-540]=[
  'AKST--Alaska Standard Time'
  ,'GIT--Gambier Island Time'
  ];
AnyTime.utcLabel[-510]=[
  'MIT--Marquesas Islands Time'
  ];
AnyTime.utcLabel[-480]=[
  'CIST--Clipperton Island Standard Time'
  ,'PST--Pacific Standard Time (North America)'
  ];
AnyTime.utcLabel[-420]=[
  'MST--Mountain Standard Time (North America)'
  ,'PDT--Pacific Daylight Time (North America)'
  ];
AnyTime.utcLabel[-360]=[
  'CST--Central Standard Time (North America)'
  ,'EAST--Easter Island Standard Time'
  ,'GALT--Galapagos Time'
  ,'MDT--Mountain Daylight Time (North America)'
  ];
AnyTime.utcLabel[-300]=[
  'CDT--Central Daylight Time (North America)'
  ,'COT--Colombia Time'
  ,'ECT--Ecuador Time'
  ,'EST--Eastern Standard Time (North America)'
  ];
AnyTime.utcLabel[-240]=[
  'AST--Atlantic Standard Time'
  ,'BOT--Bolivia Time'
  ,'CLT--Chile Standard Time'
  ,'COST--Colombia Summer Time'
  ,'ECT--Eastern Caribbean Time'
  ,'EDT--Eastern Daylight Time (North America)'
  ,'FKST--Falkland Islands Standard Time'
  ,'GYT--Guyana Time'
  ];
AnyTime.utcLabel[-210]=[
  'VET--Venezuelan Standard Time'
  ];
AnyTime.utcLabel[-180]=[
  'ART--Argentina Time'
  ,'BRT--Brasilia Time'
  ,'CLST--Chile Summer Time'
  ,'GFT--French Guiana Time'
  ,'UYT--Uruguay Standard Time'
  ];
AnyTime.utcLabel[-150]=[
  'NT--Newfoundland Time'
  ];
AnyTime.utcLabel[-120]=[
  'GST--South Georgia and the South Sandwich Islands'
  ,'UYST--Uruguay Summer Time'
  ];
AnyTime.utcLabel[-90]=[
  'NDT--Newfoundland Daylight Time'
  ];
AnyTime.utcLabel[-60]=[
  'AZOST--Azores Standard Time'
  ,'CVT--Cape Verde Time'
  ];
AnyTime.utcLabel[0]=[
  'GMT--Greenwich Mean Time'
  ,'WET--Western European Time'
  ];
AnyTime.utcLabel[60]=[
  'BST--British Summer Time'
  ,'CET--Central European Time'
  ,'WAT--West Africa Time'
  ,'WEST--Western European Summer Time'
  ];
AnyTime.utcLabel[120]=[
  'CAT--Central Africa Time'
  ,'CEST--Central European Summer Time'
  ,'EET--Eastern European Time'
  ,'IST--Israel Standard Time'
  ,'SAST--South African Standard Time'
  ];
AnyTime.utcLabel[180]=[
  'AST--Arab Standard Time (Kuwait/Riyadh)'
  ,'AST--Arabic Standard Time (Baghdad)'
  ,'EAT--East Africa Time'
  ,'EEST--Eastern European Summer Time'
  ,'MSK--Moscow Standard Time'
  ];
AnyTime.utcLabel[210]=[
  'IRST--Iran Standard Time'
  ];
AnyTime.utcLabel[240]=[
  'AMT--Armenia Time'
  ,'AST--Arabian Standard Time (Abu Dhabi/Muscat)'
  ,'AZT--Azerbaijan Time'
  ,'GET--Georgia Standard Time'
  ,'MUT--Mauritius Time'
  ,'RET--R�union Time'
  ,'SAMT--Samara Time'
  ,'SCT--Seychelles Time'
  ];
AnyTime.utcLabel[270]=[
  'AFT--Afghanistan Time'
  ];
AnyTime.utcLabel[300]=[
  'AMST--Armenia Summer Time'
  ,'HMT--Heard and McDonald Islands Time'
  ,'PKT--Pakistan Standard Time'
  ,'YEKT--Yekaterinburg Time'
  ];
AnyTime.utcLabel[330]=[
  'IST--Indian Standard Time'
  ,'SLT--Sri Lanka Time'
  ];
AnyTime.utcLabel[345]=[
  'NPT--Nepal Time'
  ];
AnyTime.utcLabel[360]=[
  'BIOT--British Indian Ocean Time'
  ,'BST--Bangladesh Standard Time'
  ,'BTT--Bhutan Time'
  ,'OMST--Omsk Time'
  ];
AnyTime.utcLabel[390]=[
  'CCT--Cocos Islands Time'
  ,'MST--Myanmar Standard Time'
  ];
AnyTime.utcLabel[420]=[
  'CXT--Christmas Island Time'
  ,'KRAT--Krasnoyarsk Time'
  ,'THA--Thailand Standard Time'
  ];
AnyTime.utcLabel[480]=[
  'ACT--ASEAN Common Time'
  ,'AWST--Australian Western Standard Time'
  ,'BDT--Brunei Time'
  ,'CST--China Standard Time'
  ,'HKT--Hong Kong Time'
  ,'IRKT--Irkutsk Time'
  ,'MST--Malaysian Standard Time'
  ,'PST--Philippine Standard Time'
  ,'SST--Singapore Standard Time'
  ];
AnyTime.utcLabel[540]=[
  'JST--Japan Standard Time'
  ,'KST--Korea Standard Time'
  ,'YAKT--Yakutsk Time'
  ];
AnyTime.utcLabel[570]=[
  'ACST--Australian Central Standard Time'
  ];
AnyTime.utcLabel[600]=[
  'AEST--Australian Eastern Standard Time'
  ,'ChST--Chamorro Standard Time'
  ,'VLAT--Vladivostok Time'
  ];
AnyTime.utcLabel[630]=[
  'LHST--Lord Howe Standard Time'
  ];
AnyTime.utcLabel[660]=[
  'MAGT--Magadan Time'
  ,'SBT--Solomon Islands Time'
  ];
AnyTime.utcLabel[690]=[
  'NFT--Norfolk Time'
  ];
AnyTime.utcLabel[720]=[
  'FJT--Fiji Time'
  ,'GILT--Gilbert Island Time'
  ,'PETT--Kamchatka Time'
  ];
AnyTime.utcLabel[765]=[
  'CHAST--Chatham Standard Time'
  ];
AnyTime.utcLabel[780]=[
  'PHOT--Phoenix Island Time'
  ];
AnyTime.utcLabel[840]=[
  'LINT--Line Islands Time'
  ];