/**
 * Created by Администратор on 01.10.15.
 */
$(document).ready(
    $("tr#task").each(function (i,val) {
        var begin=split_date(val.cells[2].textContent);
        var end=new Date();
        var diff= Math.round((begin.getTime() - end.getTime()) / 1000 / 60 / 60/ 24);
        val.cells[3].textContent=diff;
     //   if (diff<0) { val.bgColor='red'};
    }));
function split_date(d){
    var split=d.split('.');
    return new Date(split[2],split[1]-1,split[0]);
};