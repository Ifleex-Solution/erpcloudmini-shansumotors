<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/service.js.php"></script>
<!-- service Invoice js -->
<script src="<?php echo base_url() ?>my-assets/js/admin_js/service.js" type="text/javascript"></script>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4><?php echo display('service_invoice') ?></h4>
                </div>
            </div>
            <?php echo form_open_multipart('service/service/insert_service_invoice', array('class' => 'form-vertical', 'id' => '', 'name' => '')) ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4" id="payment_from_1">
                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-4 col-form-label"><?php
                                                                                        echo display('customer_name')
                                                                                        ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-8">

                                <select name="customer_id" class="form-control" id="cmbCode" required>
                                    <option value="">Select Bank</option>
                                    <?php foreach ($customer_dropdown as $customer) {
                                        echo $customer->customer_id; ?>
                                        <option value="<?php echo $customer->customer_id; ?>"><?php echo $customer->customer_name; ?></option>

                                    <?php  }   ?>
                                </select>
                                <!-- // if($this->permission1->method('add_customer','create')->access()) -->
                                <!-- <div class=" col-sm-3">
                                <a href="#" class="client-add-btn btn btn-success" aria-hidden="true"
                                    data-toggle="modal" data-target="#cust_info"><i class="ti-plus m-r-2"></i></a>
                            </div> -->
                                <!-- }   -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="employee" class="col-sm-4 col-form-label"><?php
                                                                                    echo display('employee');
                                                                                    ?></label>
                            <div class="col-sm-8">
                                <select name="employee_id[]" class="form-control" multiple="multiple">
                                    <option value=""> select One</option>
                                    <?php foreach ($employee_list as $employee) { ?>
                                        <option value="<?php echo $employee['id'] ?>">
                                            <?php echo $employee['first_name'] . ' ' . $employee['last_name'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4" id="payment_from_2">
                        <div class="form-group row">
                            <label for="customer_name_others"
                                class="col-sm-3 col-form-label"><?php echo display('customer_name') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input autofill="off" type="text" size="100" name="customer_name_others"
                                    placeholder='<?php echo display('customer_name') ?>' id="customer_name_others"
                                    class="form-control" />
                            </div>

                            <div class="col-sm-3">
                                <input onClick="active_customer('payment_from_2')" type="button" id="myRadioButton_2"
                                    class="checkbox_account btn btn-success" name="customer_confirm_others"
                                    value="<?php echo display('old_customer') ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_name_others_address"
                                class="col-sm-3 col-form-label"><?php echo display('customer_mobile') ?> </label>
                            <div class="col-sm-6">
                                <input type="text" size="100" name="customer_mobile" class=" form-control"
                                    placeholder='<?php echo display('customer_mobile') ?>'
                                    id="customer_name_others_mobile" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_name_others_address"
                                class="col-sm-3 col-form-label"><?php echo display('address') ?> </label>
                            <div class="col-sm-6">
                                <input type="text" size="100" name="customer_name_others_address" class=" form-control"
                                    placeholder='<?php echo display('address') ?>' id="customer_name_others_address" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('hanging_over') ?> <i
                                    class="text-danger">*</i></label>
                            <div class="col-sm-8">
                                <?php
                                date_default_timezone_set('Asia/Colombo');

                                $date = date('Y-m-d');
                                ?>
                                <input class="datepicker form-control" type="text" size="50" name="invoice_date"
                                    id="date" required value="<?php echo $date; ?>" tabindex="6" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="normalinvoice">
                        <thead>
                            <tr>
                                <th class="text-center product_field"><?php echo display('service_name') ?> <i
                                        class="text-danger">*</i></th>
                                <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i>
                                </th>
                                <th class="text-center "><?php echo display('charge') ?> <i class="text-danger">*</i>
                                </th>

                                <?php if ($discount_type == 1) { ?>
                                    <th class="text-center "><?php echo display('discount_percentage') ?> %</th>
                                <?php } elseif ($discount_type == 2) { ?>
                                    <th class="text-center"><?php echo display('discount') ?> </th>
                                <?php } elseif ($discount_type == 3) { ?>
                                    <th class="text-center"><?php echo display('fixed_dis') ?> </th>
                                <?php } ?>
                                <th class="text-center "><?php echo display('dis_val') ?> </th>
                                <th class="text-center "><?php echo display('vat') . ' %' ?> </th>
                                <th class="text-center "><?php echo display('vat_val') ?> </th>
                                <th class="text-center"><?php echo display('total') ?>
                                </th>
                                <th class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>
                        <tbody id="addinvoiceItem">
                            <tr>
                                <td class="product_field">

                                    <select name="service_name[]" class="form-control" id="service_name_1" onchange="getProduct(1)" required>
                                        <option value="">Select Bank</option>
                                        <?php foreach ($service_list as $services) {
                                            echo $services['service_id']; ?>
                                            <option value="<?php echo $services['service_id']; ?>"><?php echo $services['service_name']; ?></option>

                                        <?php  }   ?>
                                    </select>


                                </td>

                                <td>
                                    <input type="text" name="product_quantity[]" onkeyup="quantity_calculate(1);"
                                        onchange="quantity_calculate(1);" class="total_qntt_1 form-control text-right"
                                        id="total_qntt_1" placeholder="0.00" value="1" min="0" tabindex="8"
                                        required="required" />
                                </td>
                                <td class="invoice_fields">
                                    <input type="text" name="product_rate[]" id="price_item_1"
                                        class="price_item1 price_item form-control text-right" tabindex="9" required=""
                                        onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);"
                                        placeholder="0.00" min="0" />
                                </td>
                                <!-- Discount -->
                                <td>
                                    <input type="text" name="discount[]" onkeyup="quantity_calculate(1);"
                                        onchange="quantity_calculate(1);" id="discount_1"
                                        class="form-control text-right" min="0" tabindex="10" placeholder="0.00" />
                                    <input type="hidden" value="<?php echo $discount_type ?>" name="discount_type"
                                        id="discount_type_1">
                                </td>

                                <td>
                                    <input type="text" name="discountvalue[]" id="discount_value_1"
                                        class="form-control text-right" min="0" tabindex="18" placeholder="0.00"
                                        readonly />
                                </td>

                                <!-- VAT  -->
                                <td>
                                    <input type="text" name="vatpercent[]" onkeyup="quantity_calculate(1);"
                                        onchange="quantity_calculate(1);" id="vat_percent_1"
                                        class="form-control text-right" min="0" tabindex="19" placeholder="0.00" />

                                </td>
                                <td>
                                    <input type="text" name="vatvalue[]" id="vat_value_1"
                                        class="form-control text-right total_vatamnt" min="0" tabindex="20"
                                        placeholder="0.00" readonly />
                                </td>
                                <!-- VAT end -->


                                <td class="invoice_fields">
                                    <input class="total_price form-control text-right" type="text" name="total_price[]"
                                        id="total_price_1" value="0.00" readonly="readonly" />
                                </td>

                                <td>


                                    <!-- Discount calculate start-->
                                    <input type="hidden" id="total_discount_1" class="" />
                                    <input type="hidden" id="all_discount_1" class="total_discount dppr"
                                        name="discount_amount[]" />

                                </td>
                            </tr>
                        </tbody>
                        <tfoot>

                            <tr>
                                <td colspan="6" rowspan="2">
                                    <center><label for="details"
                                            class="  col-form-label text-center"><?php echo display('invoice_details') ?></label>
                                    </center>
                                    <textarea name="inva_details" class="form-control"
                                        placeholder="<?php echo display('invoice_details') ?>"></textarea>
                                </td>
                                <td class="text-right" colspan="1"><b><?php echo display('service_discount') ?>:</b>
                                </td>
                                <td class="text-right">
                                    <input type="text" onkeyup="quantity_calculate(1);"
                                        onchange="quantity_calculate(1);" id="invoice_discount"
                                        class="form-control total_discount text-right" name="invoice_discount"
                                        placeholder="0.00" />
                                    <input type="hidden" id="txfieldnum">
                                </td>
                                <td><button type="button" id="add_invoice_item" class="btn btn-info"
                                        name="add-invoice-item" onClick="addInputField('addinvoiceItem');"><i
                                            class='fa fa-plus'></i></button>
                                    <input type="hidden" name="" id="discount_type" value="<?php echo $discount_type ?>">
                                </td>
                            </tr>


                            <tr>

                                <td class="text-right" colspan="1"><b><?php echo display('total_discount') ?>:</b></td>
                                <td class="text-right">
                                    <input type="text" id="total_discount_ammount" class="form-control text-right"
                                        name="total_discount" value="0.00" readonly="readonly" />
                                </td>


                            </tr>
                            <tr>
                                <td class="text-right" colspan="7"><b><?php echo display('ttl_val') ?>:</b></td>
                                <td class="text-right">
                                    <input type="text" id="total_vat_amnt" class="form-control text-right"
                                        name="total_vat_amnt" value="0.00" readonly="readonly" />
                                </td>
                            </tr>



                            <tr>
                                <td colspan="7" class="text-right"><b><?php echo display('grand_total') ?>:</b></td>
                                <td class="text-right">
                                    <input type="text" id="grandTotal" class="form-control text-right grandTotalamnt"
                                        name="grand_total_price" value="0.00" readonly="readonly" />
                                </td>
                            </tr>


                        </tfoot>
                    </table>
                    <p hidden id="old-amount"><?php echo 0; ?></p>
                    <p hidden id="pay-amount"></p>
                    <p hidden id="change-amount"></p>
                    <div class="col-sm-3 table-bordered p-20">
                        <div id="adddiscount" class="display-none">
                            <div class="row no-gutters">
                                <div class="form-group ">
                                    <label for="payments" class="col-form-label pb-2"><?php echo display('payment_type'); ?> <i class="text-danger">*</i>
                                    </label>
                                    <select name="multipaytype[]" class="form-control" id="your_dropdown_id" tabindex="1">
                                        <option value="">Select an option</option>
                                        <?php foreach ($all_pmethod as $services) { ?>
                                            <option value="<?php echo $services['id']; ?>"><?php echo $services['name']; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row text-right">
                    <div class="col-sm-12 p-20">
                        <input type="submit" id="add_invoice1" class="btn btn-success" name="add-invoice"
                            value="<?php echo display('submit') ?>" tabindex="17" />

                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>

</div>

<script>
    function myFunction(count) {
        var elementById = document.getElementById("price_item_3");
        elementById.value = 45;

    }
    "use strict";
    var service_list = [];
    var countStringBuilder = [];
    countStringBuilder.push(1);

    function addInputField(t) {
    var row = $("#normalinvoice tbody tr").length;
    var count = row + 1;
       var tab1 = 0;
       var tab2 = 0;
       var tab3 = 0;
       var tab4 = 0;
       var tab5 = 0;
       var tab6 = 0;
       var tab7 = 0;
       var tab8 = 0;
       var tab9 = 0;
       var tab10 = 0;
       var tab11 = 0;
       var tab12 = 0;
    var limits = 500;
    var taxnumber = $("#txfieldnum").val();
    var tbfild ='';
    for(var i=0;i<taxnumber;i++){
        var taxincrefield = '<input id="total_tax'+i+'_'+count+'" class="total_tax'+i+'_'+count+'" type="hidden"><input id="all_tax'+i+'_'+count+'" class="total_tax'+i+'" type="hidden" name="tax[]">';
         tbfild +=taxincrefield;
    }
    if (count == limits)
        alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "service_name" + count,
                tabindex = count * 5,
                e = document.createElement("tr");
        tab1 = tabindex + 1;
        tab2 = tabindex + 2;
        tab3 = tabindex + 3;
        tab4 = tabindex + 4;
        tab5 = tabindex + 5;
        tab6 = tabindex + 6;
        tab7 = tabindex + 7;
        tab8 = tabindex + 8;
        tab9 = tabindex + 9;
        tab10 = tabindex + 10;
        tab11 = tabindex + 11;
        tab12 = tabindex + 12;
        

       // console.log(echo $service_list);
       var stringBuilder = [];
        $(document).ready(function(){
            $.ajax({
                url: 'service/service/getservice_list', // PHP script to fetch data
                type: 'GET',
                success: function(response) {
                    serviceList=JSON.parse(response);
                 
                   
        //  "<td><input type='text' name='service_name' onkeypress='invoice_serviceList(" + count + 
        // ");' class='form-control serviceSelection common_product' placeholder='Service Name' id='" + a + 
        // "' required tabindex='" + tab1 + "'><input type='hidden' class='common_product autocomplete_hidden_value  service_id_" + count + 
        // "' name='service_id[]' id='SchoolHiddenId'/></td> "+

        var countA=count-1;

        countStringBuilder.push(count);
        console.log(countStringBuilder);

        stringBuilder.push(
                "<td>" +
                    "<select name='service_name[]' class='form-control' id='service_name_" + count +
                    "' onchange='getProduct(" + count + ")' required>" +
                        "<option value=''>Select Option</option>"
            );

            for (var service of serviceList) {
                stringBuilder.push(
                    "<option value='" + service.service_id + "'>" + service.service_name + "</option>"
                );
            }

       stringBuilder.push("</select></td><td><input type='text' name='product_quantity[]' required='required' onkeyup='quantity_calculate(" + count + 
        ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "'value='1' class='common_qnt total_qntt_" + count + 
        " form-control text-right'  placeholder='0.00' min='0' tabindex='" + tab2 + "'/></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + 
        ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='common_rate price_item" + count + 
        " form-control text-right' required placeholder='0.00' min='0' tabindex='" + tab3 + "'/></td><td><input type='text' name='discount[]' onkeyup='quantity_calculate(" + count + 
        ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right common_discount' placeholder='0.00' min='0' tabindex='" + tab4 + 
        "' /> <input type='hidden' value='' name='discount_type' id='discount_type_" + count + 
        "' ></td><td><input type='text' name='discountvalue[]' readonly id='discount_value_" + count + "' class='form-control text-right common_discount' placeholder='0.00' min='0' tabindex='" + tab10 + 
        "' /></td><td><input type='text' name='vatpercent[]' onkeyup='quantity_calculate(" + count + 
        ");' onchange='quantity_calculate(" + count + ");' id='vat_percent_" + count + "' class='form-control text-right common_discount' placeholder='0.00' min='0' tabindex='" + tab11 + 
        "' /></td><td><input type='text' name='vatvalue[]' id='vat_value_" + count + "' class='form-control text-right total_vatamnt common_discount' readonly placeholder='0.00' min='0' tabindex='" + tab12 + 
        "' /></td><td class='text-right'><input class='common_total_price total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + 
        "' value='0.00' readonly='readonly'/></td><td>"+tbfild+"<input type='hidden'  id='total_discount_" + count + "' /><input type='hidden' id='all_discount_" + count + 
        "' class='total_discount dppr' name='discount_amount[]'/><button tabindex='" + tab5 + 
        "' style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'><i class='fa fa-close'></i></button></td>");
              
        e.innerHTML = stringBuilder.join("");
        document.getElementById(t).appendChild(e),
                document.getElementById(a).focus(),
                document.getElementById("add_invoice_item").setAttribute("tabindex", tab6);
        document.getElementById("paidAmount").setAttribute("tabindex", tab7);
        document.getElementById("add_invoice").setAttribute("tabindex", tab9);

                },
                error:function(error){
                    console.log(error)
                }
            });
        });

     
       console.log(countStringBuilder)
        count++
    }
}


    "use strict";

    function quantity_calculate(item) {
        var serviceLists = [];
        $(document).ready(function() {
            $.ajax({
                url: 'service/service/getservice_list', // PHP script to fetch data
                type: 'GET',
                success: function(response) {
                    serviceLists = JSON.parse(response);
                    var quantity = $("#total_qntt_" + item).val();

                    var service = serviceLists.find(obj => obj.service_id === $("#service_name_" + item).val());

                    // if( $("#price_item_" + item).val()===""){
                    //     $("#price_item_" + item).val(service.charge);

                    // }

                    // if( $("#vat_percent_" + item).val()===""){
                    //     $("#vat_percent_" + item).val(service.service_vat);
                    // }
                    var price_item = $("#price_item_" + item).val();
                    var invoice_discount = $("#invoice_discount").val();
                    var discount = $("#discount_" + item).val();
                    var vat_percent = $("#vat_percent_" + item).val();
                    var taxnumber = $("#txfieldnum").val();
                    var total_discount = $("#total_discount_" + item).val();
                    var dis_type = $("#discount_type").val();


                    if (quantity > 0 || discount > 0 || vat_percent > 0) {
                        if (dis_type == 1) {
                            var price = quantity * price_item;

                            // Discount cal per product
                            var dis = +(price * discount / 100);

                            $("#discount_value_" + item).val(dis);
                            $("#all_discount_" + item).val(dis);

                            //Total price calculate per product
                            var temp = price - dis;
                            // product wise vat start
                            var vat = +(temp * vat_percent / 100);
                            $("#vat_value_" + item).val(vat);
                            // product wise vat end
                            var ttletax = 0;
                            $("#total_price_" + item).val(temp);
                            for (var i = 0; i < taxnumber; i++) {
                                var tax = (temp) * $("#total_tax" + i + "_" + item).val();
                                ttletax += Number(tax);
                                $("#all_tax" + i + "_" + item).val(tax);

                            }


                        } else if (dis_type == 2) {
                            var price = quantity * price_item;

                            // Discount cal per product
                            var dis = (discount * quantity);
                            $("#discount_value_" + item).val(dis);
                            $("#all_discount_" + item).val(dis);

                            //Total price calculate per product
                            var temp = price - dis;
                            $("#total_price_" + item).val(temp);

                            // product wise vat start
                            var vat = +(temp * vat_percent / 100);
                            $("#vat_value_" + item).val(vat);
                            // product wise vat end
                            var ttletax = 0;
                            for (var i = 0; i < taxnumber; i++) {
                                var tax = (temp) * $("#total_tax" + i + "_" + item).val();
                                ttletax += Number(tax);
                                $("#all_tax" + i + "_" + item).val(tax);
                            }
                        } else if (dis_type == 3) {
                            var total_price = quantity * price_item;


                            // Discount cal per product
                            $("#discount_value_" + item).val(discount);
                            $("#all_discount_" + item).val(discount);
                            //Total price calculate per product
                            var price = (total_price - discount);
                            $("#total_price_" + item).val(price);

                            // product wise vat start
                            var vat = +(price * vat_percent / 100);
                            $("#vat_value_" + item).val(vat);
                            // product wise vat end
                            var ttletax = 0;
                            for (var i = 0; i < taxnumber; i++) {
                                var tax = (price) * $("#total_tax" + i + "_" + item).val();
                                ttletax += Number(tax);
                                $("#all_tax" + i + "_" + item).val(tax);
                            }
                        }
                    } else {
                        var n = quantity * price_item;
                        var c = quantity * price_item;
                        $("#total_price_" + item).val(n),
                            $("#all_tax_" + item).val(c)
                    }
                    calculateSum1();
                    // invoice_paidamount();

                    var invoice_edit_page = $("#invoice_edit_page").val();
                    var preload_pay_view = $("#preload_pay_view").val();
                    var is_credit_edit = $('#is_credit_edit').val();

                    $("#add_new_payment").empty();

                    $("#pay-amount").text('0');
                    $("#dueAmmount").val(0);
                    if (invoice_edit_page == 1) {
                        var base_url = $('#base_url').val();
                        var csrf_test_name = $('[name="csrf_test_name"]').val();
                        var gtotal = $(".grandTotalamnt").val();
                        var url = base_url + "service/service/bdtask_showpaymentmodal";
                        $.ajax({
                            type: "post",
                            url: url,
                            data: {
                                is_credit_edit: is_credit_edit,
                                csrf_test_name: csrf_test_name
                            },
                            success: function(data) {

                                $($('#add_new_payment').append(data));

                                $("#pamount_by_method").val(gtotal);
                                $("#preload_pay_view").val('1');
                                $("#add_new_payment_type").prop('disabled', false);
                                var card_typesl = $('.card_typesl').val();
                                if (card_typesl == 0) {
                                    $("#add_new_payment_type").prop('disabled', true);
                                }
                            }
                        });

                    }

                },
                error: function(error) {
                    console.log(error)
                }
            });
        });


    }

    function getProduct(item) {
        var serviceLists = [];
        $(document).ready(function() {
            $.ajax({
                url: 'service/service/getservice_list', // PHP script to fetch data
                type: 'GET',
                success: function(response) {
                    serviceLists = JSON.parse(response);
                    var quantity = $("#total_qntt_" + item).val();

                    var service = serviceLists.find(obj => obj.service_id === $("#service_name_" + item).val());

                    $("#price_item_" + item).val(service.charge);

                    $("#vat_percent_" + item).val(service.service_vat);
                    var price_item = $("#price_item_" + item).val();
                    var invoice_discount = $("#invoice_discount").val();
                    var discount = $("#discount_" + item).val();
                    var vat_percent = $("#vat_percent_" + item).val();
                    var taxnumber = $("#txfieldnum").val();
                    var total_discount = $("#total_discount_" + item).val();
                    var dis_type = $("#discount_type").val();



                    if (quantity > 0 || discount > 0 || vat_percent > 0) {
                        if (dis_type == 1) {
                            var price = quantity * price_item;

                            // Discount cal per product
                            var dis = +(price * discount / 100);

                            $("#discount_value_" + item).val(dis);
                            $("#all_discount_" + item).val(dis);

                            //Total price calculate per product
                            var temp = price - dis;
                            // product wise vat start
                            var vat = +(temp * vat_percent / 100);
                            $("#vat_value_" + item).val(vat);
                            // product wise vat end
                            var ttletax = 0;
                            $("#total_price_" + item).val(temp);
                            for (var i = 0; i < taxnumber; i++) {
                                var tax = (temp) * $("#total_tax" + i + "_" + item).val();
                                ttletax += Number(tax);
                                $("#all_tax" + i + "_" + item).val(tax);

                            }


                        } else if (dis_type == 2) {
                            var price = quantity * price_item;

                            // Discount cal per product
                            var dis = (discount * quantity);
                            $("#discount_value_" + item).val(dis);
                            $("#all_discount_" + item).val(dis);

                            //Total price calculate per product
                            var temp = price - dis;
                            $("#total_price_" + item).val(temp);

                            // product wise vat start
                            var vat = +(temp * vat_percent / 100);
                            $("#vat_value_" + item).val(vat);
                            // product wise vat end
                            var ttletax = 0;
                            for (var i = 0; i < taxnumber; i++) {
                                var tax = (temp) * $("#total_tax" + i + "_" + item).val();
                                ttletax += Number(tax);
                                $("#all_tax" + i + "_" + item).val(tax);
                            }
                        } else if (dis_type == 3) {
                            var total_price = quantity * price_item;


                            // Discount cal per product
                            $("#discount_value_" + item).val(discount);
                            $("#all_discount_" + item).val(discount);
                            //Total price calculate per product
                            var price = (total_price - discount);
                            $("#total_price_" + item).val(price);

                            // product wise vat start
                            var vat = +(price * vat_percent / 100);
                            $("#vat_value_" + item).val(vat);
                            // product wise vat end
                            var ttletax = 0;
                            for (var i = 0; i < taxnumber; i++) {
                                var tax = (price) * $("#total_tax" + i + "_" + item).val();
                                ttletax += Number(tax);
                                $("#all_tax" + i + "_" + item).val(tax);
                            }
                        }
                    } else {
                        var n = quantity * price_item;
                        var c = quantity * price_item;
                        $("#total_price_" + item).val(n),
                            $("#all_tax_" + item).val(c)
                    }
                    calculateSum1();
                    // invoice_paidamount();

                    var invoice_edit_page = $("#invoice_edit_page").val();
                    var preload_pay_view = $("#preload_pay_view").val();
                    var is_credit_edit = $('#is_credit_edit').val();

                    $("#add_new_payment").empty();

                },
                error: function(error) {
                    console.log(error)
                }
            });
        });


    }


    "use strict";

    function calculateSum1() {

        var taxnumber = $("#txfieldnum").val();

        var t = 0,
            a = 0,
            e = 0,
            o = 0,
            p = 0,
            f = 0,
            v = 0,
            ad = 0,
            ds = 0;
        // s_cost = $("#shipping_cost").val();

        //Total Tax
        for (var i = 0; i < taxnumber; i++) {

            var j = 0;
            $(".total_tax" + i).each(function() {
                isNaN(this.value) || 0 == this.value.length || (j += parseFloat(this.value))
            });
            $("#total_tax_ammount" + i).val(j.toFixed(2, 2));

        }

        //Discount part
        var p = 0,
            v = 0,
            f = 0,
            t = 0;

        // TOTAL DISCOUNT
        $(".total_discount").each(function() {
            let val = parseFloat($(this).val());
            if (!isNaN(val)) p += val;
        });
        $("#total_discount_ammount").val(p.toFixed(2));

        // TOTAL VAT
        $(".total_vatamnt").each(function() {
            let val = parseFloat($(this).val());
            if (!isNaN(val)) v += val;
        });
        $("#total_vat_amnt").val(v.toFixed(2));

        // TOTAL TAX
        $(".totalTax").each(function() {
            let val = parseFloat($(this).val());
            if (!isNaN(val)) f += val;
        });
        $("#total_tax_amount").val(f.toFixed(2));

        // TOTAL PRICE
        $(".total_price").each(function() {
            let val = parseFloat($(this).val());
            if (!isNaN(val)) t += val;
        });
        $("#total_price_all").val(t.toFixed(2)); // or your real field ID

        $(".dppr").each(function() {
                isNaN(this.value) || 0 == this.value.length || (ad += parseFloat(this.value))
            }),
            o = f.toFixed(2, 2),
            e = t.toFixed(2, 2);
        f = p.toFixed(2, 2);

        var test = +o + + +e + -f + +ad;
        $("#grandTotal").val(test.toFixed(2, 2));

        var gt = $("#grandTotal").val();
        var invdis = $("#invoice_discount").val();
        var vatamnt = $("#total_vat_amnt").val();
        var total_discount_ammount = $("#total_discount_ammount").val();
        var ttl_discount = +total_discount_ammount + +invdis;
        var grnt_totals = parseFloat(gt) + parseFloat(vatamnt);
        $("#grandTotal").val(grnt_totals.toFixed(2, 2));
        $('#paidAmount').val(grnt_totals.toFixed(2, 2));
        $("#pamount_by_method").val(grnt_totals.toFixed(2, 2));

    }
</script>