/* 
 *  Project    : EIS Subscription Module
 *  EAO IT Services Pvt. Ltd. | www.eaoservices.com
 *  Copyright reserved @2017
 
 *  File Description :
 
 *  Created on : 21 Oct, 2017 | 2:41:41 PM
 *  Author     : Bilal Wani
 *  Email      : bilal.wani@eaoservices
 
 */

/*
 * Dependency: 
 *  main.js
 */

$(document).ready(function () {
    /* EisUIClass is defined in main.js */
    var objUI = new EisUIClass();
    
    objUI.ProcessMembers('content');
    
});


