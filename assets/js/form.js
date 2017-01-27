jQuery(function($) {

var baseUrl =  $('#SignupForm').attr('data-url');

     $('#SaveAccount').click(function(event) {
                event.preventDefault();
                $("#form1").slideUp('slow');
                $("#SignupFormStep2").slideDown('slow');
                var test = $('#cop_date').val();
               // console.log('cop_date:'+test);
    });
    $('#back').click(function(event) {
                event.preventDefault();
                $("#SignupFormStep2").slideUp('slow');
                $("#form1").slideDown('slow');
    });
    $('.modal select').select2();
    $("#cop_date").datepicker();
    $("#cop_date").daterangepicker({
        singleDatePicker: true,
        locale: {
             format: 'DD-MM-YYYY',
         }
    }); 

    $("#industryClassification, #selectAcceleration, #selectAcceleratorProgramme").select2();
           var selectUni1 = $("#selectorUniversity").select2();
           var selectUni2 = $("#selectorUniversity2").select2();
           var selectRnD1 = $("#selectRnD").select2();
           var selectRnD2 = $("#selectRnD2").select2();
           //////////Added by Hamid raza//////// 
        
        // show value selected but did not show for user 
          // it is use for select value for upand down selection 
            /*  selectRnD1.on("change", function(e) {
                //  console.log(selectRnD1.val());
               selectRnD2.val(selectRnD1.val()).trigger("change.select2");       
             });
               selectRnD2.on("change", function(e) {
               selectRnD1.val(selectRnD2.val()).trigger("change.select2");       
             });
             selectUni1.on("change", function(e) {
             selectUni2.val(selectUni1.val()).trigger("change.select2");       
             });
              selectUni2.on("change", function(e) {
              selectUni1.val(selectUni2.val()).trigger("change.select2");       
             });*/
         
    function zIndex($){
            $('#main-wrap').css('z-index', 'auto');
            $('#main-content').css('z-index', 'auto');
    }
        $("input[name='incorporatedAus']").on("change",function(){
            if($(this).val() === 'Between six and three years ago'){
                $("#whollyOwned").show();
                //console.log("show");
            }else{
                $("#whollyOwned").hide();
            }
        });
        zIndex($);
        
        $("input[name=EntrepreneurProgramme]").on("change",function(){
            var EntrepreneurProgramme = $(this).val();
            if(EntrepreneurProgramme === 'Yes'){
                $("#EntrepreneurProgramme").css('display','block');
            }else{
                $("#EntrepreneurProgramme").css('display','none');
            }
        });
        $("input[name=researchOrganization]").on("change",function(){
            var researchOrganization = $(this).val();
            if(researchOrganization === 'Yes'){
                $("#selectorUniversityDiv").css('display','block');
            
            //added by hamid raza 
                $("#RnD").css('display','block');
                 var $radios = $('input:radio[name=rdExpenses]');
                 $radios.filter('[value="Less than 15%"]').prop('checked', true);
     
                 
            }else{
                $("#selectorUniversityDiv").css('display','none');
            }
        });
        $("input[name=incorporatedAus]").on("change",function(){
            var incorporatedAus = $(this).val();
            if(incorporatedAus == 'Not incorporated in Australia' || incorporatedAus == ''){
                $("#dateInsertDiv").css('display','none');
            }else{
                $("#dateInsertDiv").css('display','block');
            }
        });
        $("input[name=cohortOfEntrepreneurs]").on("change",function(){
            var cohortOfEntrepreneurs = $(this).val();
            if(cohortOfEntrepreneurs === 'Yes'){
                $("#acceleratorProgramme").css('display','block');
            }else{
                $("#acceleratorProgramme").css('display','none');
            }
        });
        $("input[name=rdExpenses]").on("change",function(){
            var RnDValue = $(this).val();
            if(RnDValue === 'Less than 15%'){
                $("#RnD").css('display','block');             
               // $("#selectorUniversityDiv").css('display','block');
               // var $radios = $('input:radio[name=researchOrganization]');
                //$radios.filter('[value="Yes"]').prop('checked', true);

            }else{
                $("#RnD").css('display','none');
            }
        });
            var $signupForm = $( '#SignupForm' );
    var ipAddress;
    $.getJSON("//jsonip.com/?callback=?", function (data) {
            ipAddress = data.ip;
    });

        zIndex($);
        var $form = $('#SignupForm');
        $("#SubmitForm").on("click",function(e){
            e.preventDefault();
           
            //$('error-box');
            $('#error-box').remove();
            $('#loading-submit').show();

            //if(grecaptcha.getResponse() == '') {
            if(1==2){          // change into above line
           // $("#mainFormDiv").append('<span id="error-box" style="background: rgba(255, 255, 255, 0.8);padding: 5px;color: #333;font-weight: bold; border: 2px solid #333;width: 100%;display: block;">Please Check The Recaptcha and trg again</span>');
          //  $('#loading-submit').hide();
            }else{
             var formData = new FormData();
                $.ajax({
                    crossOrigin: true,
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize()
                }).done(function (response) {
                    var data = response.split("::");
                    if(data[0] === "OK"){
                        formData.append('logo', $('#Logo')[0].files[0]);
                        formData.append('banner', $('#BannerImage')[0].files[0]);
                        formData.append('product', $('#productImage')[0].files[0]);
                        formData.append('sector', $('#industryClassification').val());
                        formData.append('ipAddress', ipAddress);
                        formData.append('userID', data[2]);

                            $.ajax({       
                                crossOrigin: true,
                                type: $form.attr('method'),
                                url: baseUrl+"Reg2/step2",
                                data: formData,
                                processData: false,
                                contentType: false
                            }).done(function (response) {
                                var data = response.split("::");
                                if(data[0] === 'OK'){
                                    $("#mainFormDiv").html('<span id="sucess-box" style="background:rgba(255, 255, 255, 0.8); padding: 5px; color: #333; font-weight: bold; border: 2px solid #333; width: 100%;display: block;">Thank you, Your Esic Pre-assessment Entry has been Saved.</span>');
                                    $('#loading-submit').hide();
                                }else if(data[0] === 'FAIL'){
                                     $('#loading-submit').hide();
                                }
                            });
                    }else{
                       $("#mainFormDiv").append('<span id="error-box" style="background: rgba(255, 255, 255, 0.8);padding: 5px;color: #333;font-weight: bold; border: 2px solid #333;width: 100%;display: block;">There are Errors, Please Fill All Fields</span>');
                        $('#loading-submit').hide();
                    }

                });
            }
                
       });
        $('#addRnDModel').on("click",function(e){
            e.preventDefault();
             $('.RnDModal').show();
        });
        $("#addRnD").on("click",function(){
            zIndex($);
            var selectRnD = $("#rndname");
            var selectRnDValue = selectRnD.val();
            var RndName = $("#rndname").val();
            
            var IDNumber   = $("#rndIdNumber").val();
            var Address    = $("#rndAddress").val();
            var ANZSRC     = $("#ANZSRC").val();
            var rndAppStatus = $('#rndAppStatus').val();
            if(selectRnDValue.length === 0){
                selectRnD.parents(".form-group").addClass('has-error');
                return false ;
            }else{
                selectRnD.parents(".form-group").removeClass('has-error');
            }
            var RnDCheck='0';
            var RnDFilter = $('#selectRnD option').filter(
                function(){ 
                    if($(this).html().toLowerCase() == selectRnDValue.toLowerCase()){  
                        var valuecheck       = $(this).val();
                        var selectRnD1 = $("#selectRnD").select2();
                        selectRnD1.val(valuecheck).trigger("change");
                        RnDCheck ='1';
                        $('.RnDModal').modal('hide');
                        $('.RnDModal').modal().hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('.RnDModal').hide();
                    }
                });
            var formData = new FormData();
            formData.append('rndLogoImage', $('#rndLogoImage')[0].files[0]);
            formData.append('rndname',RndName);
            formData.append('IDNumber',IDNumber);
            formData.append('Address',Address);
            formData.append('ANZSRC',ANZSRC);
            formData.append('rndAppStatus',rndAppStatus);
            if(RnDCheck=='0'){
                $.ajax({
                    url: baseUrl+"Reg2/addRnD",
                    crossOrigin: true,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type:"POST",
                    success:function(output){
                            var  data =  output.split('::');
                               if(data[0]== 'OK'){
                                    ///console.log('RndName'+RndName);
                                   var RnDID   = data[1];
                                   var RnDName = data[2];
                                   var newOption = new Option(RnDName,RnDID, true, true);
                                    $("#selectRnD").append(newOption).trigger('change');
                                    $('.RnDModal').modal('hide');
                                    $('.RnDModal').modal().hide();
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                    $('.RnDModal').hide();
                                }else if(data[0]=='Existed'){
                                    var InstitutionNameValue = $('#selectRnD option').filter(function (){ 
                                        return $(this).html() == InstitutionValue}).val();
                                    var selectUniversity     = $("#selectRnD").select2();
                                    selectUniversity.val(InstitutionNameValue).trigger("change"); 
                                    $('.RnDModal').modal('hide');
                                    $('.RnDModal').modal().hide();
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                    $('.RnDModal').hide();
                                }
                    }
                });

            }
        });

        $("#addAcceleratorProgramme").on("click",function(){
            zIndex($);
            var  AcceleratorProgrammeName     = $("#AcceleratorProgrammeName");  
            var AcceleratorProgrammeNameValue = AcceleratorProgrammeName.val();
            var acceleratorProgrammeAppStatus = $("#acceleratorProgrammeAppStatus").val();
			var accelerator_p_c               = $("#accelerator_p_c");
		    var accelerator_p_c               = accelerator_p_c.val();
            if(AcceleratorProgrammeNameValue.length === 0){
                AcceleratorProgrammeName.parents(".form-group").addClass('has-error');
                return false ;
            }else{
                AcceleratorProgrammeName.parents(".form-group").removeClass('has-error');
            }
            var Programme_Web_Address   = $("#Programme_Web_Address").val();
            var formData = new FormData();
            formData.append('ProgrammeLogoImage', $('#ProgrammeLogoImage')[0].files[0]);
            formData.append('AcceleratorProgrammeName',AcceleratorProgrammeNameValue);
            formData.append('Programme_Web_Address',Programme_Web_Address);
            formData.append('acceleratorProgrammeAppStatus',acceleratorProgrammeAppStatus);
			formData.append('accelerator_p_c',accelerator_p_c);
			

            var ProgrammeNameCheck = '0';
            var ProgrammeFilter  = $('#selectAcceleratorProgramme option').filter(
                function(){ 
                    if($(this).html() == AcceleratorProgrammeNameValue){
                        var valuecheck      = $(this).val();
                        var selectProgramme = $("#selectAcceleratorProgramme").select2();
                        selectProgramme.val(valuecheck).trigger("change"); 
                        ProgrammeNameCheck  = '1';
                        $('.acceleratorProgrammeModal').modal('hide');
                        $('.acceleratorProgrammeModal').modal().hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                });
            if(ProgrammeNameCheck=='0'){
                //console.log(AcceleratorProgrammeNameValue);
                $.ajax({
                    crossOrigin: true,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type:"POST",
                    url: baseUrl+"Reg2/addAcceleratorProgramme",
                    success:function(output){
                        var  data =  output.split('::');
                        if(data[0]=='OK'){
                            var programmeId   = data[1];
                            var programmeName = data[2]; 
                            var newOption = new Option(programmeName,programmeId, true, true);
                                $("#selectAcceleratorProgramme").append(newOption).trigger('change');
                                $('.acceleratorProgrammeModal').modal('hide');
                                $('.acceleratorProgrammeModal').modal().hide();
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                        }else if(data[0]=='Existed'){
                            var ProgrammeNameValue = $('#selectAcceleratorProgramme option').filter(function () { return $(this).html() == ProgrammeValue}).val();
                            var valuecheck         = $(this).val();
                            var selectProgramme    = $("#selectAcceleratorProgramme").select2();
                            selectProgramme.val(ProgrammeNameValue).trigger("change");  
                            $('.acceleratorProgrammeModal').modal('hide');
                            $('.acceleratorProgrammeModal').modal().hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                        }
                    }
                });
            }
        });

        $("#addInstitution").on("click",function(){
            zIndex($);
            var Institution = $("#Institution");
            var InstitutionValue = Institution.val();
			 var post_code_uni = $("#post_code_uni");
            var post_code_uni = post_code_uni.val();
            var institutionAppStatus = $("#institutionAppStatus").val();

            if(InstitutionValue.length === 0){
                Institution.parents(".form-group").addClass('has-error');
                return false ;
            }else{
                Institution.parents(".form-group").removeClass('has-error');
            }
            var InstitutionCheck='0';
            var InstitutionFilter = $('#selectorUniversity option').filter(
                function(){ 
                    if($(this).html().toLowerCase() == InstitutionValue.toLowerCase()){  
                        var valuecheck       = $(this).val();
                        var selectUniversity = $("#selectorUniversity").select2();
                        selectUniversity.val(valuecheck).trigger("change");
                        InstitutionCheck ='1';
                        $('.InstitutionModal').modal('hide');
                        $('.InstitutionModal').modal().hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                });
            var formData = new FormData();
            formData.append('institutionLogoImage', $('#institutionLogoImage')[0].files[0]);
            formData.append('institution',InstitutionValue);
            formData.append('institutionAppStatus',institutionAppStatus);
			formData.append('post_code_uni',post_code_uni);
            if(InstitutionCheck=='0'){
                $.ajax({
                    url: baseUrl+"Reg2/addInstitution",
                    crossOrigin: true,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type:"POST",
                    success:function(output){
                            var  data =  output.split('::');
                               if(data[0]=='OK'){
                                   var institutionId   = data[1];
                                   var institutionName = data[2];
                                   var newOption = new Option(institutionName,institutionId, true, true);
                                    $("#selectorUniversity").append(newOption).trigger('change');
                                    $('.InstitutionModal').modal('hide');
                                    $('.InstitutionModal').modal().hide();
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                }else if(data[0]=='Existed'){
                                    var InstitutionNameValue = $('#selectorUniversity option').filter(function (){ 
                                        return $(this).html() == InstitutionValue}).val();
                                    var selectUniversity     = $("#selectorUniversity").select2();
                                    selectUniversity.val(InstitutionNameValue).trigger("change"); 
                                    $('.InstitutionModal').modal('hide');
                                    $('.InstitutionModal').modal().hide();
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                }
                    }
                });

            }
        });
        $("#addEntrepreneurProgramme").on("click",function(){
            zIndex($);
            var Member = $("#Member");  
            var MemberValue = Member.val();
            if(MemberValue.length === 0){
                Member.parents(".form-group").addClass('has-error');
                return false ;
            }else{
                Member.parents(".form-group").removeClass('has-error');
            }
            var Web_Address         = $("#Web_Address").val();
            var Project_Title       = $("#Project_Title").val();
            var State_Territory     = $("#State_Territory").val();
            var Project_Summary     = $("#Project_Summary").val();
            var Project_Location    = $("#Project_Location").val();
 			var acceleration_p_c    = $("#acceleration_p_c");
            var acceleration_p_c    = acceleration_p_c.val();
            var Market              = $("#Market").val();
            var Technology          = $("#Technology").val();
            var ProgrammeNameCheck  = '0';
            var EntrepreneurProgrammeAppStatus = $("#EntrepreneurProgrammeAppStatus").val();
            var ProgrammeFilter  = $('#selectAcceleration option').filter(
                function(){ 
                    if($(this).html() == MemberValue){
                        var valuecheck      = $(this).val();
                        var selectProgramme = $("#selectAcceleration").select2();
                        selectProgramme.val(valuecheck).trigger("change"); 
                        ProgrammeNameCheck  = '1';
                        $('.EntrepreneurProgrammeModal').modal('hide');
                        $('.EntrepreneurProgrammeModal').modal().hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                });
            var formData = new FormData();
            formData.append('accLogoImage', $('#accLogoImage')[0].files[0]);
            formData.append('Market',Market);
            formData.append('Member',MemberValue);
            formData.append('Technology',Technology);
            formData.append('Web_Address',Web_Address);
            formData.append('Project_Title',Project_Title);
            formData.append('State_Territory',State_Territory);
            formData.append('Project_Summary',Project_Summary);
            formData.append('Project_Location',Project_Location);
			formData.append('acceleration_p_c',acceleration_p_c);
            formData.append('EntrepreneurProgrammeAppStatus',EntrepreneurProgrammeAppStatus);
            if(ProgrammeNameCheck=='0'){
                $.ajax({
                    url: baseUrl+"Reg2/addEntrepreneurProgramme",
                    crossOrigin: true,
                    data: formData,
                    processData: false,
                    contentType: false,
                    type:"POST",
                    success:function(output){
                        var  data =  output.split('::');
                        if(data[0]=='OK'){
                            var programmeId   = data[1];
                            var programmeName = data[2]; 
                            var newOption = new Option(programmeName,programmeId, true, true);
                                $("#selectAcceleration").append(newOption).trigger('change');
                                $('.EntrepreneurProgrammeModal').modal('hide');
                                $('.EntrepreneurProgrammeModal').modal().hide();
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                        }else if(data[0]=='Existed'){
                            var ProgrammeNameValue = $('#selectAcceleration option').filter(function () { return $(this).html() == ProgrammeValue}).val();
                            var valuecheck         = $(this).val();
                            var selectProgramme    = $("#selectAcceleration").select2();
                            selectProgramme.val(ProgrammeNameValue).trigger("change");  
                            $('.EntrepreneurProgrammeModal').modal('hide');
                            $('.EntrepreneurProgrammeModal').modal().hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        }
                    }
                });
            }
        });
        $("input[name='incorporatedAus']").on("change",function(){
            if($(this).val() === 'Between six and three years ago'){
                $("#whollyOwned").show();
                //console.log("show");
            }else{
                $("#whollyOwned").hide();
            }
        });
       
        $("#addClassification").on("click",function(){
            zIndex($);
            var Industry = $("#Industry");
            var IndustryValue = Industry.val();
            var industryAppStatus = $("#industryAppStatus").val();
            
            if(IndustryValue.length === 0){
                Industry.parents(".form-group").addClass('has-error');
                return false ;
            }else{
                Industry.parents(".form-group").removeClass('has-error');
            }
            var IndustryNameCheck = '0';
            var Industryfilter    = $('#industryClassification option').filter(
                function(){ 
                    if($(this).html() == IndustryValue){
                        var valuecheck      = $(this).val();
                        var selectIndustry  = $("#industryClassification").select2();
                        selectIndustry.val(valuecheck).trigger("change"); 
                        IndustryNameCheck='1';
                        $('.IndustryClassificationModal').modal('hide');
                        $('.IndustryClassificationModal').modal().hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                });
                    var formData = new FormData();
                    formData.append('secLogoImage', $('#secLogoImage')[0].files[0]);
                    formData.append('Industry',IndustryValue);
                    formData.append('industryAppStatus',industryAppStatus);
                if(IndustryNameCheck=='0'){
                    $.ajax({
                        url: baseUrl+"Reg2/addIndustryClassification",
                        crossOrigin: true,
                        data: formData,
                        processData: false,
                        contentType: false,
                        type:"POST",
                        success:function(output){
                            var  data =  output.split('::');    
                            if(data[0]=='OK'){
                                var IndustryId   = data[1];
                                var IndustryName = data[2]; 
                                var newOption    = new Option(IndustryName,IndustryId, true, true);
                                    $("#industryClassification").append(newOption).trigger('change');
                                    $('.IndustryClassificationModal').modal('hide');
                                    $('.IndustryClassificationModal').modal().hide();
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                            }else if(data[0]=='Existed'){
                                var IndustryNameValue   = $('#industryClassification option').filter(function () { return $(this).html() == IndustryValue}).val();
                                var valuecheck          = $(this).val();
                                var selectIndustry      = $("#industryClassification").select2();
                                selectIndustry.val(IndustryNameValue).trigger("change"); 
                                $('.IndustryClassificationModal').modal('hide');
                                $('.IndustryClassificationModal').modal().hide();
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();

                            }
                        }
                    });
                }
        });
		
		
		// added by Hamid raza For scroll top 
		$('#SaveAccount').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
        });
		
		$( "#Company").focusout(function() {
              var vl = jQuery(this).val();
			   
			  for(var i = 0; i < pausecontent.length; i++) 
			  { 
			 var strings = pausecontent[i];
			  if(strings.indexOf(vl) !== -1){
				  $('#dialog').modal('toggle');
				 }
			 }
			  
        });
		
	 
		
 });
