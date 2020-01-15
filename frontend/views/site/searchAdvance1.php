<?php

use yii\helpers\Html;

//use yii\bootstrap\ActiveForm;
//use yii\widgets\ActiveForm;
//use yii\captcha\Captcha;
//use yii\jui\DatePicker;

$this->title = 'Advance Search';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--treeview-->
<link href="http://prerelease.componentone.com/wijmo5/latest/styles/wijmo.min.css" rel="stylesheet" />
<script src="http://prerelease.componentone.com/wijmo5/latest/controls/wijmo.min.js"></script>
<script src="http://prerelease.componentone.com/wijmo5/latest/controls/wijmo.input.min.js"></script>
<script src="http://prerelease.componentone.com/wijmo5/latest/controls/wijmo.nav.min.js"></script>
<script src="http://prerelease.componentone.com/wijmo5/latest/controls/wijmo.grid.min.js"></script>

<style type="text/css">
    .container{
        margin : 10px;
    }
    .list-horizontal li {
        display:inline-block;
    }
    .list-horizontal li:before {
        content: '\00a0\2022\00a0\00a0';
        color:#999;
        color:rgba(0,0,0);
        font-size:10px;
    }
    .list-horizontal li:first-child:before {
        /*content: '';*/
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div id="treeView" class="wj-control wj-content wj-treeview" tabindex="0" role="tree">

            </div>
        </div>
        <div class="col-sm-8" style="border: 1px solid black; ">
            
            <form id="form" name="form" class="form-inline bv-form" style="margin-bottom: 20px;" novalidate="novalidate" action="/site/search">
                <div class="row">
                    <div class="panel ">
                        <div class="panel-body">


                        <input type="text" id="textbox" name="q" style="width: 600px">
                        <input type="submit" id="search-submit-button">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group">
                        &nbsp;<label for="startDate">From Date</label>
                        <input id="startDate" name="startDate" type="text" class="form-control" data-bv-field="startDate">
                        &nbsp;&nbsp;
                        <label for="endDate">To Date</label>
                        <input id="endDate" name="endDate" type="text" class="form-control" data-bv-field="endDate">
                        <small id="errMsg"></small>
                        <input type="hidden" name="court_code" id="court_code" />
                        <input type="hidden" name="advance_search" value="1" />
                    </div>


                </div>
            </form>
            
            <div class="row">
                <h3>Advance search examples</h3>
                <ul>
                    <li>murder dowry will search for words "murder" and "dowry"</li>
                    <li>murder NOT dowry will search for murder where word dowry is not mentioned</li>
                    <li>"murder dowry" will search murder dowry as phrase</li>
                    <li>"murder dowry"~10 will search for murder and dowry maximum apart form each other by 10 words</li>
                    <li>murder OR dowry will search for any of the two words</li>
                    <li>"arms act" AND murder will look for arms act as phrase and word murder</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    /*var bindDateRangeValidation = function (f, s, e) {
        if (!(f instanceof jQuery)) {
            console.log("Not passing a jQuery object");
        }

        var jqForm = f,
                startDateId = s,
                endDateId = e;



        var bindValidator = function () {
            var bstpValidate = jqForm.data('bootstrapValidator');
//            alert(bstpValidate);
            var validateFields = {
                startDate: {
                    validators: {
                        notEmpty: {message: 'This field is required.'},
                        callback: {
                            message: 'From Date must less than or equal to To Date.',
                            callback: function (startDate, validator, $field) {
                                return checkDateRange(startDate, $('#' + endDateId).val())
                            }
                        }
                    }
                },
                endDate: {
                    validators: {
                        notEmpty: {message: 'This field is required.'},
                        callback: {
                            message: 'To Date must greater than or equal to From Date.',
                            callback: function (endDate, validator, $field) {
                                return checkDateRange($('#' + startDateId).val(), endDate);
                            }
                        }
                    }
                },
                customize: {
                    validators: {
                        customize: {message: 'customize.'}
                    }
                }
            }
            if (!bstpValidate) {
                jqForm.bootstrapValidator({
                    excluded: [':disabled'],
                })
            }

            jqForm.bootstrapValidator('addField', startDateId, validateFields.startDate);
            jqForm.bootstrapValidator('addField', endDateId, validateFields.endDate);

        };

        var hookValidatorEvt = function () {
            var dateBlur = function (e, bundleDateId, action) {
                jqForm.bootstrapValidator('revalidateField', e.target.id);
            }
        }

        bindValidator();
        hookValidatorEvt();
    };*/


    var checkDateRange = function (startDate, endDate) {

        var sd = moment(startDate, "DD/MM/YYYY");
        var ed = moment(endDate, "DD/MM/YYYY");

        var sd = sd.toDate();
        var ed = ed.toDate();
        var isValid = (startDate != "" && endDate != "") ? (sd <= ed) : true;
//            alert('return '+isValid);
        return isValid;
    }
    $(function () {

        var sd = new Date(), ed = new Date();
        $("#form").submit(function(){
            var error = error2 = true;
            var temp = $("#startDate").val();
            temp = temp.split('/');

            if((Array.isArray(temp))){
                var fstartDate= new Date( (temp[2] + '/' + temp[1] + '/' + temp[0]) );
            }else{
                var fstartDate= new Date( );
            }
            var temp = $("#endDate").val();
            temp = temp.split('/');

            if((Array.isArray(temp))){
                var fendDate = new Date( (temp[2] + '/' + temp[1] + '/' + temp[0]) );
            }else{
                var fendDate = new Date( );
            }

            if(!checkLength()){
                error = false;
            }

            var dateCheck = checkDateRange(fstartDate, fendDate);
            if(!dateCheck){
                error2 = false;
                $('#errMsg').html('Start date should be less than or equal to End date');
            }

            /*console.log('198', error, error2);
            console.log( '199', (error && error2));*/
            return (error && error2);
        });
        $('#startDate').datetimepicker({
            pickTime: false,
            format: "DD/MM/YYYY",
//            defaultDate: sd,
            maxDate: ed
        });
        /*$('.date')
            .on('dp.change dp.show', function(e) {
                // Revalidate the date when user change it
                $('#form').bootstrapValidator('revalidateField', 'startDate');
            });*/

        $('#endDate').datetimepicker({
            pickTime: false,
            format: "DD/MM/YYYY",
//            defaultDate: sd,
            //minDate: sd
            maxDate: ed
        });

        //passing 1.jquery form object, 2.start date dom Id, 3.end date dom Id
        bindDateRangeValidation($("#form"), 'startDate', 'endDate');
    });
    var items = [<?= $courtsData ?>
        /*{header: 'India', Id: 1, items: [
         {header: 'Supreme Court', Id: 2},
         {header: 'High Court', Id: 3, items: [
         {header: 'MP high court', Id: 4},
         {header: 'Allahbad High Court', Id: 5},
         {header: 'Bombay High Court', Id: 6}
         ]
         },
         {header: 'Tribunals', Id: 7, items: [
         {header: 'Central adminitrative', Id: 8},
         {header: 'Income Tax Appellate', Id: 9}
         ]},
         ]},
         {header: 'International', Id: 10, items: [
         {header: 'USA', Id: 11, items: [
         {header: 'Fedral Court', Id: 12},
         ]},
         ]},*/
    ];


    onload = function () {

        var treeView = new wijmo.nav.TreeView('#treeView', {
            displayMemberPath: 'header',
            childItemsPath: 'items',
            itemsSource: items,
            allowDragging: true,
            showCheckboxes: true,
            checkedItemsChanged: function (s, e) {
                var courtIds = '';
                var arrCourtId = [];
                s.checkedItems.forEach(function (item, index) {
                    arrCourtId.push(item.id);
                });
                courtIds = arrCourtId.join(',');
                $('#court_code').val(courtIds);
            }
        });
//        var node = treeView.getNode(treeView.nodes[0].dataItem.items[2].items[0]);
//        node.setChecked(true, true);
//        node = treeView.getNode(treeView.nodes[0].dataItem.items[3].items[1]);
//        node.setChecked(true, true);
    }

    function checkLength() {
        var textbox = document.getElementById("textbox");
        if (textbox.value.length >= 3) {
//            alert("success");
            return true;
        } else {
            alert("make sure the input character more than 2 letters");
            return false;
        }
    }

</script>

<!--<button type="submit"></button>-->

