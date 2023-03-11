package com.adisaint.client.utils.server;

import com.adisaint.client.config.server.Server;
import com.alibaba.fastjson.JSON;
import com.alibaba.fastjson.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.Socket;
import java.nio.charset.StandardCharsets;

/**
 * @author zhong
 * @date 2023-02-06 12:00
 */
public class SendMessage {
    /**
     * 发送消息至注册服务端
     * 并发回JSON对象消息
     *
     * @param msg 信息
     * @return 发送回来的信息转成JSON对象
     * @throws IOException 抛出IOException异常
     */
    public static JSONObject sendMessageToRegisterServer(String msg) throws IOException {
        return JSON.parseObject(sendMessageToServer(msg, Server.SERVER_ADDRESS, Server.REGISTER_SERVER_PORT, 1024));
    }


    /**
     * 发送消息至登录服务端
     * 并发回JSON对象消息
     *
     * @param msg 消息
     * @return 发送回来的信息转成JSON对象
     * @throws IOException 抛出IOException异常
     */
    public static JSONObject sendMessageToLoginServer(String msg) throws IOException {
        return JSON.parseObject(sendMessageToServer(msg, Server.SERVER_ADDRESS, Server.LOGIN_SERVER_PORT, 1024));
    }


    /**
     * 发送消息至指定主机
     * 并返回接受到的消息
     * 接受到的消息要指定大小(Bytes)
     *
     * @param msg  消息
     * @param host 主机
     * @param port 端口
     * @param size 接受的消息大小
     * @return 接受到的消息
     * @throws IOException 抛出IOException异常
     */
    public static String sendMessageToServer(String msg, String host, int port, int size) throws IOException {
        Socket socket = new Socket(host, port);
        OutputStream outputStream = socket.getOutputStream();
        outputStream.write(msg.getBytes(StandardCharsets.UTF_8));
        InputStream inputStream = socket.getInputStream();
        byte[] bytes = new byte[size];
        int length = inputStream.read(bytes);
        String data = new String(bytes, 0, length, StandardCharsets.UTF_8).trim();
        socket.close();
        System.out.println(data);
        return data;
    }
}
