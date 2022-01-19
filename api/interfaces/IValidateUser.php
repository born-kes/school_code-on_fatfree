<?php

namespace interfaces;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IValidateUser
 *
 * @author lukasz.martyn
 */
interface IValidateUser {
 
 public function userValidate(string $userName): bool;

 public function validateLogin(string $userName, string $userPassword): bool;

 public function access(): bool;

}
