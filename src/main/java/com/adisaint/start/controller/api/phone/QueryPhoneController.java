package com.adisaint.start.controller.api.phone;

import com.adisaint.utils.phone.Phone;
import com.adisaint.utils.string.StringUtils;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.HashMap;
import java.util.Map;


/**
 * @author zhong
 * @date 2023-03-04 12:11
 */
@RestController
public class QueryPhoneController {

    @RequestMapping("api/query/phone")
    public Map ReturnString(String phone, String code) {
        Map<String, Object> result = new HashMap<>();
        if (phone != null) {
            if (!phone.equals("")) {
                if (code == null || code.equals("") || code.equals("86")) {
                    if (StringUtils.isPhone(phone)) {
                        result.put("success", true);
                        result.put("info", new Phone(phone).getMap());
                    } else {
                        result.put("success", false);
                        result.put("message", "Invalid mobile number");
                    }
                } else {
                    try {
                        result.put("success", true);
                        result.put("info", new Phone(phone, code).getMap());
                    } catch (Exception e) {
                        result.put("success", false);
                        result.put("message", "Invalid mobile number");
                    }
                }
            } else {
                result.put("success", false);
                result.put("message", "Invalid mobile number");
            }
        } else {
            result.put("success", false);
            result.put("message", "Parameter error");
        }
        return result;
    }
}
