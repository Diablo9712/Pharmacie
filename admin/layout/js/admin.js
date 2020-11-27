//--------------------------start jquery framwordk------------------------//
//gloabl function
function send_infoclient(id,param){
   var data=new FormData();
   $(id).val(param);
   data.append("id",param);
    $.ajax({
        url:"phpaction/fetchSclient.php",
        method:"POST",
        data:data,
        processData:false,
        contentType:false,
        success:function (data) {
                data=JSON.parse(data);
                $("#id_Nax").val(data[1]);
                $("#F_namex").val(data[2]);
                $("#telx").val(data[3]);

          }
    });

  }
function send_id (id_inp,id){
    $(id_inp).val(id);
  }
  function empy_msg(param){
    $(param).empty();
}
function set_errotNeg(tag,msg,cnt) {
    var n=parseInt(tag.val());
    if(tag.val()<0)
    {
        if(tag.hasClass("error")==false)
        {
            tag.after('<p class="ntc text-danger">'+msg+' </p>');
            tag.addClass("error");
            
        }
        cnt++;
    }
    return cnt;
  }
function set_error(tag,msg,cnt)
{
   if(tag.val()=='' || tag.val()==null)
   {
       if(tag.hasClass("error")==false)
       {
           tag.after('<p class="ntc text-danger">'+msg+' </p>');
           tag.addClass("error");
           
       }
       cnt++;
   }
   return cnt;
}
//remove error if have  value
function remv_error(tag)
{

    var tem=$(tag+" + .ntc");
           tem.remove();
           $(tag).removeClass("error");
}

//end gloabal function
$(function(){
        "use strict";
        //confirmation
    //on focus remove placeholder
        $('[placeholder]').focus(function()
        {
            $(this).attr("data-text",$(this).attr("placeholder"));
            $(this).attr("placeholder",''); 
        }).blur(function()
        {
             $(this).attr("placeholder",$(this).attr("data-text"));
             $(this).attr("data-text",'');   
        });
    //add astrict to required input 
        $('[required="required"]').each(function (){
            $(this).after("<span class='astric'>*</span>");
        });

    //this for show add form client
        $("#add-c").click(function (){
            $(".add-c").removeClass('hidden');
        });
        
    //styl de input file 
        $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });
        // We can watch for our custom `fileselect` event like this
        
    $(document).ready( function() {
        var recd;
        var page=1;
        load_datap(recd,page);
        load_datac(recd,page);
        load_datacmd(recd,page);
        load_dataadv(recd,page);
    //--------------------------Advance List-------------------------------------//
    $("#add-detail").click(function () {
          var  ctn=0;
        var data=new FormData();

        var id=$("#id_adv");
        var dt=$("#dt_paye");
        var money=$("#m_paye");
        //set error fro money
        ctn=set_error(money,"prix obliger",ctn);
         //set error fro date
         ctn=set_error(dt,"La date  obliger",ctn);
        data.append("id",id.val());
        data.append("dt",dt.val());
        data.append("money",money.val());
            
              var xm=parseInt(money.val());
            if(ctn==0)
            {
                console.log("stage 1");
                if(xm < 0)
                {
                    ctn=set_errotNeg(money,"prix doit positive",ctn);

                }else if(xm>0){
                $.ajax({
                    url:"phpaction/addadvanced.php",
                    method:"POST",
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(data)
                    {
                        dt.val("");
                        money.val("");
                        console.log(data);
                        load_dataadv($("#rc_crnt").val(),$("#pg_act").val());
                    }
                });
            }
        }
    });
    $(document).on('click','.pgnadv',function(){
                
        var page=$(this).attr("id");
            $("#pg_act").val(page);
        var rcrd=$("#rc_crnt").val();
        console.log(page+""+recd);
        load_dataadv(rcrd,page);
    
    }); 
    $('#rc_crnt').change(function(){
        page=1;
        var rcrd=$(this).val();
        load_dataadv(rcrd,page);
        console.log(rcrd);
    
    });
    function load_dataadv(rc_cmd,page)
            {
                
                $.ajax({

                    url:"phpaction/fetchLadvace.php",
                    method:"POST",
                    data:{rc_crnt:rc_cmd,page:page},
                    success:function(data)
                    {
                        $("#table_carnet").empty();
                        $("#table_carnet").append(data);
                    
                    }
                });
            }
    //--------------------------command------------------------------------------//
    $(document).on('click','.pgncmd',function(){
                
        var page=$(this).attr("id");
        var rcrd=$("#rc_cmd").val();
        console.log(page+""+recd);
        load_datacmd(rcrd,page);
    
    }); 
    $('#rc_cmd').change(function(){
        page=1;
        var rcrd=$(this).val();
        load_datacmd(rcrd,page);
    
    });
    function load_datacmd(rc_cmd,page)
            {
                $.ajax({

                    url:"phpaction/fetchcmd.php",
                    method:"POST",
                    data:{rc_cmd:rc_cmd,page:page},
                    success:function(data)
                    {
                        $("#tabledatacmd").empty();
                        $("#tabledatacmd").append(data);
                    
                    }
                });
            }
    //--------------------------client-------------------------------------------//
    var x=1;
    $("#cl-add").click(function (){
        $("#id_Na").val('');
        $("#F_name").val('');
        $("#telx").val('');
    });
    $("#btn-editc").click(function ( ) {
        var data=new FormData();
            data.append("id_cln",$("#id_cln").val());
            data.append("id_Na",$("#id_Nax").val());
            data.append("F_name",$("#F_namex").val());
            data.append("tel",$("#telx").val());
            if($("#F_namex").val()!='' || $("#F_namex").val()!=null){
                $.ajax({
                    url:"phpaction/updateclient.php",
                    method:"POST",
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(data)
                    {
                        $("#msg-editc").empty();
                        $("#msg-editc").append(data);
                        load_datac($("#rc_c").val(),x);
                    
                    }
                });
            }
      });
    $("#btn-addc").click(function (){
        $("#msg-addc").empty();
        var data=new FormData();
        data.append("id_Na",$("#id_Na").val());
        data.append("F_name",$("#F_name").val());
        data.append("tel",$("#tel").val());
        if($("#F_name").val()!='' || $("#F_name").val()!=null){
            $.ajax({
                url:"phpaction/addclient.php",
                method:"POST",
                data:data,
                processData:false,
                contentType:false,
                success:function(data)
                {
                    $("#msg-addc").empty();
                    $("#msg-addc").append(data);
                    load_datac($("#rc_c").val(),1);
                
                }
            });
        }
    });
   
    $("#remv-clnt").click(function (){
        var data=new FormData();
        data.append("id",$("#id_client").val());
        $.ajax({
            url:"phpaction/remv_client.php",
            type:"post",
            data:data,
            processData:false,
            contentType:false,
            success:function(data){
                    $("#msg-clnt").empty(); 
                    $("#msg-clnt").append(data);
                    load_datac($("#rc_c").val(),x);
            }
        });
    });
    $(document).on('click','.pgnc',function(){
            $(this).addClass("act_p");
        var page=$(this).attr("id");
        var rcrd=$("#rc_c").val();
        load_datac(rcrd,page);
        x=page;
        
    
    });  
    $('#rc_c').change(function(){
        page=1;
        var rcrd=$(this).val();

        load_datac(rcrd,page);
    
    });
    function load_datac(rc_c,page)
            {
                $.ajax({

                    url:"phpaction/fecthclient.php",
                    method:"POST",
                    data:{rc_c:rc_c,page:page},
                    success:function(data)
                    {
                        $("#tabledatac").empty();
                        $("#tabledatac").append(data);
                    
                    }
                });
            }
    //----------------------------product-----------------------------//
            $(document).on('click','.pgn',function(){
                
                var page=$(this).attr("id");
                var rcrd=$("#rcrd").val();
                load_datap(rcrd,page);
            
            });  
            $('#rcrd').change(function(){
                page=1;
                var rcrd=$(this).val();
                console.log(page+" "+rcrd);
                load_datap(rcrd,page);
            
            });
            function load_datap(rcrd,page)
            {
                $.ajax({

                    url:"phpaction/fetchproduct.php",
                    method:"POST",
                    data:{rcrd:rcrd,page:page},
                    success:function(data)
                    {
                        $("#tabledata").empty();
                        $("#tabledata").append(data);
                    
                    }
                });
            }  
        $(':file').on('fileselect', function(event, numFiles, label) {
                var input = $(this).parents('.input-group').find(':text'),
                    log = label;
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }});
        });
    //without loading

    });
    $("select option").click(function () {
        console.log($(this).val());
        console.log("i tyred");
    });
    //---------------------start js code----------------------------//
    $(document).ready(function(){
                //---------------start filter advance table---------------/
                $("#s_crnt").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                        $("#tb-adv tr").filter(function() {
                            if($(this).attr("class")!="thd")
                            {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            }
                        });
                    
            });
                //---------------end filter advance table---------------/
        //---------------start filter command---------------/
        $("#s_cmd").on("keyup", function() {
            var value = $(this).val().toLowerCase();
                $("#tbl-cmd tr").filter(function() {
                    if($(this).attr("class")!="thd")
                    {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    }
                });
            
    });
        //---------------end filter command---------------/
         //---------------------filter-- client---------------------------//
        $("#s_name").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                    $("#tb-client tr").filter(function() {
                        if($(this).attr("class")!="thd")
                        {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        }
                    });
                
        });
    //-----------------------filter product------------------------//
            $("#px_name").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                        $("#tb-product tr").filter(function() {
                            if($(this).attr("class")!="thd")
                            {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                            }
                        });
        //
            });
    //--------------end filter------------------------------//
        $(document).ready(function(){
            
            var url_img=$("#url_img"),
                    P_name=$("#P_name"),
                    Px_unit =$("#Px_unit"),
                    Px_buy =$("#Px_buy"),
                    qts=$("#qts"),
                    catg =$("#catg"),
                    dt_time=$("#dt_time"),
                    txurl_img=$("#txurl_img"),
                    id_P=$("#id_P"),
                    ctn=0;
            //remove product
            
            $("#btn-rmv").click(function (){
                var data=new FormData();
                    data.append("id_pr",$("#id-pr").val());
                $.ajax({
                    url:"phpaction/remv_prod.php",
                    type:"post",
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(data){
                       
                        $("#rmv-msg").empty();
                        $("#rmv-msg").append(data).delay(5000).queue(function () {
                                $("#mo-d").hide("fast",function () {
                                    $(this).modal('toggle');
                                  });
                                  $(this).empty();
                                  $(this).dequeue();
                              });
                            
                    }
                });
            });
            //update
            $("#btn_updateprod").click(function (){
                ctn=0;
                let data=new FormData(); 
                data.append("url_img",url_img[0].files[0]); 
                data.append("P_name",P_name.val());
                data.append("Px_unit",Px_unit.val());
                data.append("Px_buy",Px_buy.val());
                data.append("qts",qts.val());
                data.append("catg",catg.val());
                data.append("id_P",id_P.val());
                data.append("txurl_img",txurl_img.val())
                data.append("dt_time",dt_time.val());

                $.ajax({
                    url        : "phpaction/updateProduct.php",
                    type       : "post",
                    data       : data,
                    processData: false,
                    contentType: false,
                    success    : function(data) {
                                    $("#md-product").empty().removeClass("hidden");
                                    
                                 $("#md-product").append(data);
                                $("#md-product").show("slow", function() {
                                    // $(this).append(data);
                                     $(this).delay(5000).hide("slow", function() {
                                         $(this).empty().addClass("hidden");
                                 });
                                });
                                
                                }
                });
            });
            //add prodcut
            $("#add_product").click(function (){
                ctn=0;
                let data=new FormData(); 
                data.append("url_img",url_img[0].files[0]);
                data.append("P_name",P_name.val());
                data.append("Px_unit",Px_unit.val());
                data.append("Px_buy",Px_buy.val());
                data.append("qts",qts.val());
                data.append("catg",catg.val());
                data.append("dt_time",dt_time.val());
                //set alert name
                ctn=set_error(P_name,"Le nom obliger",ctn);
                  //set alert name
                  ctn=set_error(Px_unit,"Prix d'ache obliger",ctn);
                    //set alert name
                ctn=set_error(Px_buy,"Prix de vent obliger",ctn);
                  //set alert name
                  ctn=set_error(qts,"Quantite obliger",ctn);
                  //set alert name
                  ctn=set_error(dt_time,"Date obliger",ctn);
                if(ctn===0){
                        $.ajax({
                            url        : "phpaction/upload.php",
                            type       : "post",
                            data       : data,
                            processData: false,
                            contentType: false,
                            success    : function(data) {
                                            $("#md-product").empty();
                                        //   $("#md-product").append(data);
                                        $("#md-product").show("slow", function() {
                                            $(this).append(data);
                                            $(this).delay(3000).hide("slow", function() {
                                                $(this).empty();
                                            });
                                        });
                                        
                                        }
                        });
                    }
                });
            $("#md-cls").click(function (){
                $("#md-product").empty();
                url_img.attr("src","data/Uploads/default.png");
                P_name.val("");
                Px_unit.val(0);
                Px_buy.val(0);
                qts.val(0);
                catg.val("1")
                dt_time.val("");
            });
            //edit product
            var url=window.location.href;
            if(url.search('product.php')!=-1 && url.search('actn=Edit')!=-1 )
            {   $("#id_P").val(myrow[0]);
                $("#p_sh").attr("src",myrow[6]);
                $("#txurl_img").val(myrow[6]);
                $("#url_img").val('');
                $("#P_name").val(myrow[1]);
                $("#Px_buy").val(myrow[3]);
                $("#Px_unit").val(myrow[2]);
                $("#qts").val(myrow[4]);
                $("#catg").val(myrow[5]);
                $("#dt_time").val(myrow[7]);
            }
        
        });   
    });
    //function of command--------------
    function rmvrow(id){
        $("#cmd tbody #"+id).remove();
        
    }

    function qts_total(){
        var q_total=0,qts;
        $("td .q").each(function(){
            qts=$(this).val();
            if(qts !=='')
            {
                q_total+=parseInt(qts);
            }else{
                q_total+=0;
            }
        });
        $('#qts-total').val(q_total);
    }
    //-------------------get prix total of product-------------------------//
    //set 
    function price_total()
    {
        var p=$("td .p"),p_total=0,predu=$('#reduction'),prix_redu=0;
            $("td .p").each(function (){
                if($(this).val()!=="")
                {
                    p_total+=parseFloat($(this).val());
                }
             if(predu.val()=='' || predu.val()==0)
             {   
                    predu.val(0);
                    prix_redu=0;
             }
             else{
                 prix_redu=predu.val(); //(p_total*predu)/100;
                //  prix_redu=prix_redu.toFixed(2);
             }
             
        });
        p_total-=prix_redu;
        $('#prix-total').val(p_total)
    }
     //-------------------get pix of product-------------------------//
     function rmvs_readonly(n=null)
     {
         if(n !=null)
         {
            remv_error('#s'+n) 
            remv_error('#q'+n);
            remv_error('#qts-total');
            remv_error('#p'+n);
            remv_error('#prix-total');
         }
     }
     function set_type_payment()
     {
         var tp_py=$("#tp-py").val();
         if(tp_py==1)
         {
            $("#dv-crdt").addClass("hidden");
         }
        else if(tp_py==2)
         {
            $("#dv-crdt").removeClass("hidden");
         }
     }
     function get_info_cmd()
     {
         var formd=new FormData(),i_req=0,msg;
         var tbl_prod={
                productid:[],
                qts:[],
                price:[]
            };
         $('td .s').each(function (){
            tbl_prod.productid[tbl_prod.productid.length]=$(this).val();
            msg="produit important";
            i_req=set_error($(this),msg,i_req);
         });
         $('td .p').each(function (){
            tbl_prod.price[ tbl_prod.price.length]=$(this).val();
            msg='prix oblige';
             i_req=set_error($(this),msg,i_req);
        });
        $('td .q').each(function (){
            tbl_prod.qts[ tbl_prod.qts.length]=$(this).val();
            msg='quantite obige';
            i_req=set_error($(this),msg,i_req);
        });
        var idclient =   $("#S_clnt"),
            cmd_dt   =   $("#dt"),
            cmd_tm   =   $("#tm"),
            qts_ttl  =   $("#qts-total"),
            rd       =   $("#reduction"),
            mtd      =   $("#tp-py"),
            info_pay =   [],
            prix_total=$("#prix-total")
            dt_start=$("#dt_strt"),
            dt_end =$("#dt_expert"),
            adv    =$("#adv_p");
            var test=new Date();
               console.log(prix_total);

            if(mtd.val()==1)
            {
                info_pay=['1'];
                console.log(info_pay);
            }else if(mtd.val()==2)
            {
                        info_pay=[dt_start.val(),dt_end.val(),adv.val()];

                        i_req=set_error(dt_start,'date depart oblige',i_req);
                        i_req=set_error(dt_end,'date expert oblige',i_req);
                        i_req=set_error(adv,'advance  oblige',i_req);
                    
                          
            }else{
                //add messge shoose method
                
                i_req=set_error(mtd,"choisi un method",i_req);
            }
            //----------------------------------
            //add message if user forget field 
            //client
            i_req=set_error(idclient,'client oblige',i_req);
            //date
            i_req=set_error(cmd_dt,'date oblige',i_req);
            //time
            i_req=set_error(cmd_tm,'time oblige',i_req);
            //reduction 
            i_req=set_error(rd,'reduction oblige',i_req);
            //quantite total qts-total
            i_req=set_error(qts_ttl,'quantite total oblige',i_req);
            //prix totla prix-total
            i_req=set_error(prix_total,'prix total oblige',i_req);
            //---------collection data----------------------------
                var data_cltn ={idclient:idclient.val(),
                                cmd_dt:cmd_dt.val(),
                                cmd_tm:cmd_tm.val(),
                                qts_ttl:qts_ttl.val(),
                                rd:rd.val(),
                                prix_total:prix_total.val(),
                                info_pay};
                console.log(data_cltn);
            //----------add data to from data-------
            var tbl_jsonorod=JSON.stringify(tbl_prod),
                tbl_client=JSON.stringify(data_cltn);
            formd.append("tbl_prod",tbl_jsonorod);
            formd.append("tbl_client",tbl_client);
            //-----------end addition------------------
            if(i_req ===0){
                $.ajax({ 
                    url:"phpaction/addcmd.php",
                    method:"POST",
                    data:formd,
                    processData: false,
                    contentType: false,
                    success:function(data)
                    {
                        $("#cmd_msg").after("<div class='alert-success' style='height:50px; padding-top:10px;'>command bien ajoute</div>"+data);
                        //remove msg
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        });
                        idclient.val("Nom de client"); 
                        cmd_dt.val("");      
                        cmd_tm.val("");      
                        qts_ttl.val("");     
                        rd.val("");
                        mtd.val("method"); 
                        prix_total.val("");
                        dt_start.val("");
                        dt_end.val("");
                        adv.val("");   
                        $("#s1").val("Produit");
                            $("#p1").val("");
                            $("#q1").val(""); 
                        x_Cmdi=$('#cmd tbody tr').length+1;
                        for (let i = 2; i <= x_Cmdi; index++) {
                            rmvrow(2);
                        }
                    }
                });
        }
            
     }
    function cal_price(qtsid= null){
        if($('#s'+qtsid).val() !=='' || $('#s'+qtsid).val() != null )
        {
                var price=$("#p"+qtsid),qts=$("#q"+qtsid);
                if(price.val() !=="")
                {
                 price.val(qts.val()* price.attr("data-price")); 
                }
                price_total();
        }
    }
    function getprice(id = null)
    {
        var id_prod=$('#s'+id).val(),price=$('#p'+id);
        var quant=$("#q"+id).val(1);
             
             $.ajax({
                 url:"phpaction/fetchselectproduct.php",
                 method:"POST",
                 data:{s:id_prod},
                 dataType: 'json',
                 success:function(data)
                 {
                    price.val(data.Px_unit);
                    price.attr('data-price',price.val());
                    price_total();
                    
                 }
             });
        
    }
    //end function ---------------
    $(document).ready(function(){
        $(".prod-val").click(function (){

        });
        //datetiem piker
    //-------------------start operation command---------------------//

    var cmdi=1;
    function add_content(r,optPorduct)
    {
        r="<tr id="+cmdi+">\
        <td>\
            <div>\
                <select class='form-control s' id='s"+cmdi+"' onchange='getprice("+cmdi+");qts_total();rmvs_readonly("+cmdi+")'>\
                <option selected disabled>Produit</option>\
                "+optPorduct+"\
                </select>\
            </div>\
        </td>\
        <td>\
            <div class='col-sm-7 col-md-7'>\
            <input type='number' class='form-control q'  min='1' required='required' id='q"+cmdi+"' onchange='cal_price("+cmdi+");qts_total();'/>\
            </div>\
        </td>\
        <td>\
            <div class='col-sm-7 col-md-7'>\
            <input type='number' class='form-control p'  readonly required='required' id='p"+cmdi+"'/>\
            </div>\
        </td>\
        <td>\
            <div class='col-sm-7 col-md-7'>\
                <button type='button' class='btn btn-danger' onclick='rmvrow("+cmdi+");cal_price(2);qts_total();'><i class='fa fa-trash-o'></i></button>\
            </div>\
        </td>\
    </tr>";
    $('#cmd tbody').append(r);
    }
        
    $("#add-cmdr").click(function(){
        cmdi=$('#cmd tbody tr').length+1;
        var optPorduct,r='';
        
        $.ajax({
            url:"phpaction/fecthoptionprodcut.php",
            method:"POST",
            data:{},
            success:function(data)
            {
                optPorduct=data;
                add_content(r,optPorduct);
            }
        });

       
    });
    

//-------------------end operation command----------------------//
});
