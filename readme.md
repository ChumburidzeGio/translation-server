Hack to retrive ids from insurance wizard

```javascript
var lis = document.querySelectorAll('.products-list.design1 li');

var ids = '';

lis.forEach(function(currentValue, index, arr) {
  ids += "'" + currentValue.getAttribute("data-product") + "',";
});
ids;
```