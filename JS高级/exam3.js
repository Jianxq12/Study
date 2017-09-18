
(function (window,document) {
    Function.prototype.sort = function (arr) {
        for (var i = 0; i < arr.length; i++) {
            for (var j = 0; j < arr.length; j++) {
                if(arr[j] > arr[j+1] ){
                    arr[j] = [arr[j+1],arr[j+1]=arr[j]][0];
                }

            }
        }
        return arr;
    }
    
    
    var arr1 = [1,24,36,4,83];
    var sort1 = new Function();
    sort1.sort(arr1);
    console.log(sort1.sort(arr1));;

})(window,document)