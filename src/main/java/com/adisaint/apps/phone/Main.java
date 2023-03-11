package com.adisaint.apps.phone;

import com.adisaint.apps.phone.core.PrintInfo;
import com.adisaint.utils.print.ColorCode;
import com.adisaint.utils.print.ColorPrint;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

/**
 * @author zhong
 * @date 2023-03-09 12:28
 */
public class Main {
    public static void main(String[] args) {
        List<String> array = new ArrayList<>(Arrays.asList(args));
        try {
            String phone = null;
            String code = null;
            if (array.contains("-p")) {
                phone = array.get(array.indexOf("-p") + 1);
            } else {
                ColorPrint.outPrintln("Error: Please enter the phone number", ColorCode.RED);
                System.exit(0);
            }
            if (array.contains("-c")) {
                code = array.get(array.indexOf("-c") + 1);
            }
            if (code == null) PrintInfo.printInfo(phone);
            else PrintInfo.printInfo(phone, code);
        } catch (IndexOutOfBoundsException indexOutOfBoundsException) {
            ColorPrint.outPrintln("Error: Arguments error", ColorCode.RED);
        } catch (NumberFormatException numberFormatException) {
            ColorPrint.outPrintln("Error: Number code does not exist", ColorCode.RED);
        }
    }
}
