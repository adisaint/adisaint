package com.adisaint.apps.phone.core;

import com.adisaint.utils.phone.PhoneUtils;

import java.sql.SQLOutput;

/**
 * @author zhong
 * @date 2023-03-09 12:29
 */
public class PrintInfo {
    public static void main(String[] args) {
        printInfo("18779737112");
    }

    public static void printInfo(String phone) {
        String location = PhoneUtils.getPhoneNumberLocation(phone);
        String operation = PhoneUtils.getPhoneNumberOperation(phone);
        System.out.println("Phone Number: " + phone);
        System.out.println("Phone Location: " + location);
        System.out.println("Phone Operation: " + operation);
    }

    public static void printInfo(String phone, String code) {
        String location = PhoneUtils.getPhoneNumberLocation(phone, code);
        String operation = PhoneUtils.getPhoneNumberOperation(phone, code);
        System.out.println("Phone Number: " + phone);
        System.out.println("Phone Code: " + code);
        System.out.println("Phone Location: " + location);
        System.out.println("Phone Operation: " + operation);
    }
}
