                            if (strpos($product['name'], '+') == true ) {
                                $arrProduct = explode(", ", $product['name']);
                                $filteredNames = array_filter($arrProduct, function($item) {
                                    return strpos($item, '+') === 0;
                                });
                                $strNames = implode(", ", $filteredNames);

                                $arrProduct = explode(", ", $strNames);
                                $filteredNames = array_map(function($item) {
                                    return ltrim($item, '+');
                                }, $arrProduct);
                                $result = implode(", ", $filteredNames);
                                
                                if ($data[$i] == $result) {
                                    parent::$conn->query("
                                        update products 
                                        set 
                                            sale = '{$newSale}',
                                            quantity = '{$newQuantity}',
                                            total = '{$newTotal}'
                                        where 
                                            name = '{$result}'
                                    ");
                                }
                            }