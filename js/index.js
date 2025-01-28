function payementd(e)
{
    if(e.value=='Cheque')
    {
        $('#CheckNoid').css('display', 'block');
        $('#uTRNOid').css('display', 'none');
    }
    else if(e.value=='VANDANA BANK' || e.value=='BAJAJ BANK' )
    {
        $('#uTRNOid').css('display', 'block');
        $('#CheckNoid').css('display', 'none');
    }
}
        
function Payementbutton1() {
    if ($('#full_name').val() == '' || $('#RecieveBy').val() == '' || $('#Date').val() == '' || $('#CourseFees').val() == '' 
      || $('#batch_time').val() == '' || $('#PaidFees').val() == '' || $('#BalanceFees').val() == '' || $('#Payement').val() == ''
      || $('#course').val() == '' || $('#Remark').val() == '') {
        alert('Please Enter all the Credentials');
        return false;
    } else {
        return true;
    }
}
function caLBalance()
{
    paidfees=document.getElementById('PaidFees').value
    CourseFees=document.getElementById('CourseFees').value
    balancefees= CourseFees-paidfees;
    document.getElementById('BalanceFees').value=balancefees
    if(paidfees=='')
        {
            document.getElementById('BalanceFees').value=''
        }
    
    
}
function caLBalanceup()
{
    paidfees=document.getElementById('PaidFees').value
    CourseFees=document.getElementById('CourseFees').value
    balancefees= CourseFees-paidfees;
    document.getElementById('BalanceFees').value=balancefees
    if(paidfees=='')
        {
            document.getElementById('BalanceFees').value=''
        }  
}