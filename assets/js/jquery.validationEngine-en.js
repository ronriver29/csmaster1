(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* This field is required",
                    "alertTextCheckboxMultiple": "* Please select an option",
                    "alertTextCheckboxe": "* This checkbox is required",
                    "alertTextDateRange": "* Both date range fields are required"
                },
                "requiredInFunction": {
                    "func": function(field, rules, i, options){
                        return (field.val() == "test") ? true : false;
                    },
                    "alertText": "* Field must equal test"
                },
                "dateRange": {
                    "regex": "none",
                    "alertText": "* Invalid ",
                    "alertText2": "Date Range" 
                },
                "dateTimeRange": {
                    "regex": "none",
                    "alertText": "* Invalid ",
                    "alertText2": "Date Time Range"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* Minimum ",
                    "alertText2": " characters required"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* Maximum ",
                    "alertText2": " characters allowed"
                },
		"groupRequired": {
                    "regex": "none",
                    "alertText": "* You must fill one of the following fields",
                    "alertTextCheckboxMultiple": "* Please select an option",
                    "alertTextCheckboxe": "* This checkbox is required"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* Minimum value is "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* Maximum value is "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* Date prior to "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* Date past "
                },
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* Maximum ",
                    "alertText2": " options allowed"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* Please select ",
                    "alertText2": " options"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* Fields do not match"
                },
                "creditCard": {
                    "regex": "none",
                    "alertText": "* Invalid credit card number"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
                    "alertText": "* Invalid phone number"
                },
                "email": {
                    // HTML5 compatible email regex ( http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#    e-mail-state-%28type=email%29 )
                    "regex": /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                    "alertText": "* Invalid email address"
                },
                "fullname": {
                    "regex":/^([A-Z]+[a-zA-Z Ññ]*[\'\,\.\-]?[a-zA-Z Ññ]*)+([ ]+[A-Z]+[a-zA-Z ]*[\'\,\.\-Ññ]?)+$/,
                    // "regex":/^[\u00F1A-Za-z _,.]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/,
                    "regex":/^[\u00F1A-Za-z _,.]*[\u00F1A-Za-z][\u00F1A-Za-z _ Ññ,-.]*$/, //json
                    "alertText":"* Must be Last Name and First Name"
                },
                "validID": {
                    "regex":/^(?=.*\d)[a-z\d]*$/,
                    "alertText":"* Only Letters with Numbers/Numbers Only"
                },
                "zip": {
                    "regex":/^\d{5}$|^\d{5}-\d{4}$/,
                    "alertText":"* Invalid zip format"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* Not a valid integer"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
                    "alertText": "* Invalid floating decimal number"
                },

                "date": {
                    //	Check if date is valid by leap year
			"func": function (field) {
					var pattern = new RegExp(/^(\d{4})[\/\-\.](0?[1-9]|1[012])[\/\-\.](0?[1-9]|[12][0-9]|3[01])$/);
					var match = pattern.exec(field.val());
					if (match == null)
					   return false;

					var year = match[1];
					var month = match[2]*1;
					var day = match[3]*1;
					var date = new Date(year, month - 1, day); // because months starts from 0.

					return (date.getFullYear() == year && date.getMonth() == (month - 1) && date.getDate() == day);
				},
			 "alertText": "* Invalid date, must be in DD-MM-YYYY format"
                },
                "ipv4": {
                    "regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* Invalid IP address"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* Invalid URL"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* Numbers only"
                },
                "TIN": {
                    "regex": /^[0-9]{3}([\-][0-9]{3}){2,3}$/,
                    "alertText": "* Invalid T.I.N format"
                },
                "onlyMobileNumber":{
                  "regex": /^[0][1-9]\d{9}$/,
                  "alertText": "* Must be 11 digit number and start with 0"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* Letters only"
                },
				        "onlyLetterAccentSp":{
                    "regex": /^[a-z\u00C0-\u017F\ ]+$/i,
                    "alertText": "* Letters only (accents allowed)"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* No special characters allowed"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxAreaCallPhp": {
                    "url": "check_coverage_validity",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#coopArea'],
                    "alertText": "* This coverage area is not allowed",
                    "alertTextOk": "* Valid option",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxEmailCallPhp": {
                    "url": "check_email_exists",
                    // you may want to pass extra data on the ajax call
                    "alertText": "* This email is already taken",
                    "alertTextOk": "* This email is available",
                    "alertTextLoad": "* Validating, please wait"
                },//check cooperative name
                "ajaxCoopNameCallPhp": {
                    "url": "check_coop_name_exists",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#typeOfCooperative'],
                    "alertText": "* This cooperative name is not available",
                    "alertTextOk": "* This cooperative name is available",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCoopNameUpdateCallPhp": {
                    "url": "../check_coop_name_update_exists",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#typeOfCooperative,#cooperativeID'],
                    "alertText": "* This cooperative name is not available",
                    "alertTextOk": "* This cooperative name is available",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCoopNameExpiredCallPhp": {
                    "url": "../check_coop_name_exists",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#typeOfCooperative,#cooperativeID'],
                    "alertText": "* This cooperative name is not available",
                    "alertTextOk": "* This cooperative name is available",
                    "alertTextLoad": "* Validating, please wait"
                },
                //Amendment name
                "ajaxAmendmentNameCallPhp": {
                    "url": "check_amendment_name_exists",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic":['#typeOfCooperative_value','#cooperative_idss'],
                    "alertText": "* This  Cooperative name is not available",
                    "alertTextOk": "* This  Cooperative name is available",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCooperatorCallPhp": {
                    "url": "../../laboratories_cooperators/check_cooperator_not_exist",
                    "url": "../../amendment_cooperators/check_cooperator_not_exist",
                    "url": "../../cooperators/check_cooperator_not_exist",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* This cooperator already exists.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCooperatorAmendmentCallPhp": {
                    "url": "../../amendment_cooperators/check_cooperator_not_exist",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperative_id','#amd_id'],
                    "alertText": "* This cooperator already exists.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCooperatorAmendmentEditCallPhp": {
                    "url": "../../amendment_cooperators/check_edit_position_not_exist",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperative_id','#amd_id','#cooperatorID'],
                    "alertText": "* This cooperator already exists.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCooperatorPositionCallPhp": {
                    "url": "../../laboratories_cooperators/check_position_not_exist",
                    "url": "../../amendment_cooperators/check_position_not_exist",
                    "url": "../../cooperators/check_position_not_exist",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* This position is already occupied.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCooperatorPositionCallAmendmentPhp": {
                    "url": "../../amendment_cooperators/check_position_not_exist",
                    "extraDataDynamic": ['#cooperative_id','#amd_id'],
                    "alertText": "* This position is already occupied.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxEditCooperatorName": {
                    "url": "../../laboratories_cooperators/check_edit_cooperator_not_exist",
//                    "url": "../../amendment_cooperators/check_edit_cooperator_not_exist",
                    "url": "../../cooperators/check_edit_cooperator_not_exist",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperatorID, #cooperativesID'],
                    "alertText": "* This cooperator already exists.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                  "ajaxEditCooperatorNameAmendment": {
                   "url": "../../amendment_cooperators/check_edit_cooperator_not_exist",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperatorID, #cooperative_id,#amd_id'],
                    "alertText": "* This cooperator already exists.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxEditCooperatorPosition": {
                    "url": "../../laboratories_cooperators/check_edit_position_not_exist",
//                    "url": "../../amendment_cooperators/check_edit_position_not_exist",
                    "url": "../../cooperators/check_edit_position_not_exist",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperatorID, #cooperativesID'],
                    "alertText": "* This position is already occupied.",
                    "alertTextOk": "",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxCommitteeNameCallPhp": {
                    "url": "check_committee_name_not_exists",
                    // "url": "../check_committee_name_not_exists", //for edit commitee
                    // you may want to pass extra data on the ajax call
                    "alertText": "* This committee name already exists. Please select it in the dropdown.",
                    "alertTextOk": "* This committee name is available.",
                    "alertTextLoad": "* Validating, please wait"
                },
                 "ajaxCommitteeNameCallPhpAmendment": {
                    "url": "check_committee_name_not_exists",
                    // you may want to pass extra data on the ajax call
                    "alertText": "* This committee name already exists. Please select it in the dropdown.",
                    "alertTextOk": "* This committee name is available.",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxUserNameCallPhpEdit": { 
                    "url": "check_username_not_exists",
                    // you may want to pass extra data on the ajax call
                    "alertText": "* This username already exists.",
                    "alertTextOk": "* This username is available.",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxUserNameCallPhpEdit": { 
                    "url": "../check_username_not_exists_edit",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#adID'],
                    "alertText": "* This username already exists.",
                    "alertTextOk": "* This username is available.",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumRegularSubscriptionCallPhp": {
                    "url": "../../bylaws/check_minimum_regular_subscription_amendment",
                    "url": "../../bylaws/check_minimum_regular_subscription",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum regular subscription indicated in the bylaws and Must not be greater than 10% of your Total no of subscribed capital",
                    "alertTextOk": "* This is greater than or equal to the minimum regular subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                 "ajaxMinimumRegularSubscriptionAmendmentCallPhp": {
                    "url": "../amendmentbylaws/check_minimum_regular_subscription_amendment",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperative_id','#amd_id'],
                    "alertText": "* Must be greater than or equal to the minimum regular subscription indicated in the bylaws and Must not be greater than 10% of your Total no of subscribed capital",
                    "alertTextOk": "* This is greater than or equal to the minimum regular subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumRegularPayCallPhp": {
                    "url": "../../bylaws/check_minimum_regular_pay",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum regular pay indicated in the bylaws",
                    "alertTextOk": "* This is greater than or equal to the minimum regular pay subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumRegularPayCallPhpAmendment": {
                    "url": "../../amendmentbylaws/check_minimum_regular_pay",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#amd_id'],
                    "alertText": "* Must be greater than or equal to the minimum regular pay indicated in the bylaws",
                    "alertTextOk": "* This is greater than or equal to the minimum regular pay subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },

                "ajaxMinimumAssociateSubscriptionCallPhp": {
                    "url": "../../bylaws/check_minimum_associate_subscription",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum associate subscription indicated in the bylaws and Must not be greater than 10% of your Total no of paid-up capital",
                    "alertTextOk": "* This is greater than or equal to the minimum associate subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                 "ajaxMinimumAssociateSubscriptionCallPhpAmendment": {
                    "url": "../../amendmentbylaws/check_minimum_associate_subscription",
                     "url": "../../../amendmentbylaws/check_minimum_associate_subscription",
                     "url": "../../../../amendmentbylaws/check_minimum_associate_subscription",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperatorID,#cooperative_id,#amd_id'],
                    "alertText": "* Must be greater than or equal to the minimum associate subscription indicated in the bylaws and Must not be greater than 10% of your Total no of paid-up capital",
                    "alertTextOk": "* This is greater than or equal to the minimum associate subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                    //pay up share associate
                "ajaxMinimumAssociatePayEditAmendmentCallPhp": {
                    "url": "../../amendmentbylaws/check_minimum_associate_pay_amendment",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperatorID,#cooperative_id,#amd_id'],
                    "alertText": "* Must be greater than or equal to the minimum associate pay indicated in the bylaws",
                    "alertTextOk": "* This is greater than or equal to the minimum associate pay subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumAssociatePayCallPhp": {
                    "url": "../../bylaws/check_minimum_associate_pay",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum associate pay indicated in the bylaws",
                    "alertTextOk": "* This is greater than or equal to the minimum associate pay subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumRegularSubscriptionEditCallPhp": {
                    "url": "../../../bylaws/check_minimum_regular_subscription",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum regular subscription indicated in the bylaws and Must not be greater than 10% of your Total no of subscribed capital",
                    "alertTextOk": "* This is greater than or equal to the minimum regular subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumRegularPayEditCallPhp": {
                    "url": "../../../bylaws/check_minimum_regular_pay",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum regular pay indicated in the bylaws",
                    "alertTextOk": "* This is greater than or equal to the minimum regular pay subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumRegularPayEditCallPhpAmendment": {
                    "url": "../../../amendmentbylaws/check_minimum_regular_pay",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#amd_id'],
                    "alertText": "* Must be greater than or equal to the minimum regular pay indicated in the bylaws",
                    "alertTextOk": "* This is greater than or equal to the minimum regular pay subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumAssociateSubscriptionEditCallPhp": {
//                    "url": "../../../bylaws/check_minimum_associate_subscription",
                    "url": "../../../../bylaws/check_minimum_associate_subscription",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum associate subscription indicated in the bylaws and Must not be greater than 10% of your Total no of paid-up capital",
                    "alertTextOk": "* This is greater than or equal to the minimum associate subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxMinimumAssociatePayEditCallPhp": {
                    "url": "../../../bylaws/check_minimum_associate_pay",
                    "url": "../../../../bylaws/check_minimum_associate_pay",
                    // you may want to pass extra data on the ajax call
                    "extraDataDynamic": ['#cooperativesID'],
                    "alertText": "* Must be greater than or equal to the minimum associate pay indicated in the bylaws",
                    "alertTextOk": "* This is greater than or equal to the minimum associate pay subscription indicated in the bylaws",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* Validating, please wait"
                },
				"ajaxUserCallPhp": {
                    "url": "phpajax/ajaxValidateFieldUser.php",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* This username is available",
                    "alertText": "* This user is already taken",
                    "alertTextLoad": "* Validating, please wait"
                },
                "ajaxNameCall": {
                    // remote json service location
                    "url": "ajaxValidateFieldName",
                    // error
                    "alertText": "* This name is already taken",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* This name is available",
                    // speaks by itself
                    "alertTextLoad": "* Validating, please wait"
                },
				 "ajaxNameCallPhp": {
	                    // remote json service location
	                    "url": "phpajax/ajaxValidateFieldName.php",
	                    // error
	                    "alertText": "* This name is already taken",
	                    // speaks by itself
	                    "alertTextLoad": "* Validating, please wait"
	                },
                "validate2fields": {
                    "alertText": "* Please input HELLO"
                },
                "validateAge": {
                  "alertText": "* Age must be 18 years old and above"
                },
                "validateActivityNotNull": {
                  "alertText": "* Please select first your type of cooperative"
                },
                "validateLabAge1": {
                  "alertText": "* Age must be greather than 6  and less than 18 years old"
                },
                "validateActivityInName": {
                  "alertText": "* Don't include the type of your cooperative in the proposed name"
                },
                "validateCooperativeWordInName": {
                  "alertText": "* Don't include the word cooperative, union, or federation and Cooperative Type"
                },
                "validateCooperativeParenthesesInAcronym": {
                  "alertText": "* Don't include Parentheses in Acronym Name"
                },
                "validateOthersInCommitteeName": {
                  "alertText": "* Please specify committee name. Dont use the word other/s"
                },
                "validateMinimumPaidRegular": {
                  "alertText": "* Must be equal or less than the minimum subscription for regular"
                },
                "validateMinimumPaidAssociate": {
                  "alertText": "* Must be equal or less than the minimum subscription for associate"
                },
                "validateMemberUponApproval": {
                    "alertText": "* It must be atlest 25% of total subscription"
                },
                "validateMemberUponApprovalRegular": {
                    "alertText": "* It must be atleast 25% of total subscription"
                },
                "validateTotalAuthorizedShareCapitalRegular": {
                  "alertText": "* Authorized share capital must be the total of number of common shares multiplied by par value of common share"
                },
                "validateTotalAuthorizedShareCapitalAssociate": {
                  "alertText": "* Authorized share capital must be the total of (number of common shares multiplied by par value of common share + number of preferred shares multiplied by par value of preferred share)"
                },
                "validateNumberOfPaidUpGreater" : {
                  "alertText": "* Must not be greater than the number of subscribed shares"
                },
                "validateNumberOfPaidUpGreaterAmendment" : {
                  "alertText": "* Must not be greater than the number of subscribed shares"
                },
	            //tls warning:homegrown not fielded
                "dateFormat":{
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
                    "alertText": "* Invalid Date"
                },
                //tls warning:homegrown not fielded
				"dateTimeFormat": {
	                "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/,
                    "alertText": "* Invalid Date or Date Format",
                    "alertText2": "Expected Format: ",
                    "alertText3": "mm/dd/yyyy hh:mm:ss AM|PM or ",
                    "alertText4": "yyyy-mm-dd hh:mm:ss AM|PM"
	            },
                //modified
                 "validateAmendment_proposed_name": {
                  "alertText": "* Do not include the word Cooperative or Multipurpose Cooperative in the proposed name"
                }
            };

        }
    };

    $.validationEngineLanguage.newLang();

})(jQuery);
