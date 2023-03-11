package com.adisaint.start.controller.test;

import com.adisaint.start.config.database.MySQL;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Value;
import org.springframework.web.bind.annotation.RequestMapping;


/**
 * @author zhong
 * @date 2023-03-05 17:07
 */
public class ReturnConfig {
    @Value("${mysql.password}")
    private String password;

    @Autowired
    private MySQL mysql;

    @RequestMapping("pwd")
    public MySQL fun() {
        return mysql;
    }
}
