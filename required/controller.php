<?php
include '../model/database.php';
include '../model/shop.php';

$shop = new Shop;
if (isset($_POST['login'])) {
    $shop->Auth();
}
if (isset($_POST['addproduct'])) {
    $shop->AddProduct();
}
if (isset($_POST['product_list'])) {
    $shop->productList();
}
if (isset($_POST['updateProduct'])) {
    $shop->UpdateProduct();
}
if (isset($_POST['optionData'])) {
    $shop->optionData();
}
if (isset($_POST['addshop'])) {
    $shop->addshop();
}
if (isset($_POST['updateShop'])) {
    $shop->updateShop();
}
if (isset($_POST['autocomplete'])) {
    $shop->autoProduct();
}
if (isset($_POST['addUser'])) {
    $shop->addUser();
}
if (isset($_POST['invoiced'])) {
    $shop->invoiced();
}
if (isset($_POST['selectProduct'])) {
    $shop->selectProduct();
}
if (isset($_POST['update_cart'])) {
    $shop->update_cart();
}
if (isset($_POST['removedFromCart'])) {
    $shop->removedFromCart();
}
if (isset($_POST['sellProduct'])) {
    $shop->sellProduct();
}
if (isset($_POST['changePass'])) {
    $shop->changePass();
}
if (isset($_POST['item_level_update'])) {
    $shop->item_level_update();
}
if (isset($_POST['user_delete'])) {
    $shop->user_delete();
}
if (isset($_POST['user_update'])) {
    $shop->user_update();
}
if (isset($_POST['user_reset'])) {
    $shop->user_reset();
}
if (isset($_POST['shopPointProduct'])) {
    $shop->shopPointProduct();
}
if (isset($_POST['product_delete'])) {
    $shop->product_delete();
}
if (isset($_POST['pointmedEdit'])) {
    $shop->pointmedEdit();
}
if (isset($_POST['place_order_btn'])) {
    $shop->place_orde();
}
if (isset($_POST['delete_request'])) {
    $shop->delete_request();
}
if (isset($_POST['sellReport'])) {
    $shop->sellReport();
}
if (isset($_POST['transferProduct'])) {
    $shop->transferProduct();
}
