Hack to retrive ids from insurance wizard

```javascript
var lis = document.querySelectorAll('.products-list.design1 li');

var ids = '';

lis.forEach(function(currentValue, index, arr) {
  var productId = currentValue.getAttribute("data-product");
  if (productId == null) {
    return null;
  }
  ids += "'" + productId + "', ";
});
ids;

```