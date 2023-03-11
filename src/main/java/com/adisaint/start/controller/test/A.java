package com.adisaint.start.controller.test;

import jakarta.servlet.http.HttpServletRequest;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public
class A {
    /**
     * 获取登录的方式
     */
    @GetMapping("url/ip")
    public static String getRequestHeader(HttpServletRequest request) {
        // 从浏览器获取请求头信息
        String info = request.getHeader("user-agent");
        if (info.contains("Windows")) {
            System.out.println("Windows pc端登陆");
            return "Windows pc端登陆";
        }

        if (info.contains("Macintosh")) {
            System.out.println("Mac pc端登陆");
            return "Mac pc端登陆";
        }

        if (info.contains("Android")) {
            System.out.println("Android移动客户端");
            return "Android移动客户端";
        }

        if (info.contains("iPhone")) {
            System.out.println("iPhone移动客户端");
            return "iPhone移动客户端";
        }

        if (info.contains("iPad")) {
            System.out.println("iPad客户端");
            return "iPad客户端";
        }
        System.out.println("其他客户端");
        return "其他客户端";
    }
}