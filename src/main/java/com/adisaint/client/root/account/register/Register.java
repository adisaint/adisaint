package com.adisaint.client.root.account.register;

import java.io.IOException;
import java.util.Date;
import java.util.Objects;

import javafx.application.Application;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.stage.Stage;

import com.adisaint.client.config.images.logo.Logo;
import com.alibaba.fastjson.JSONObject;
import com.adisaint.utils.string.StringUtils;

import static com.adisaint.client.utils.server.SendMessage.sendMessageToRegisterServer;


public class Register extends Application {

    public static void main(String[] args) {
        launch(args);
    }

    static {
        System.out.println("Loading register...");
    }

    @Override
    public void start(Stage stage) throws IOException {
        Parent root = FXMLLoader.load(Objects.requireNonNull(getClass().getResource("Register.fxml")));
        Scene scene = new Scene(root, 377, 303);
        stage.setTitle("欢迎注册Gandjax");
        stage.setScene(scene);
        stage.getIcons().add(new Image(Logo.LOGO_PATH));
        stage.show();
    }

    @FXML
    TextField usernameText, emailText, codeText;
    @FXML
    PasswordField passwordText;
    @FXML
    Button registerButton, sendCodeButton;

    /**
     * 发送验证码的次数
     */
    private Integer sendCodeCount = 0, registerSuccessCount = 0;
    /**
     * 等待发送验证码的时间
     */
    private Long endWaitSendCodeTime = 0L;


    /**
     * 点击发送验证码按钮的事件
     *
     * @throws IOException 抛出IOException异常
     */

    public void sendVerificationCode() throws IOException {
        Alert alert;
        if (new Date().getTime() > endWaitSendCodeTime) {
            String email = emailText.getText();
            if (email.equals("")) {
                alert = new Alert(Alert.AlertType.ERROR, "请输入邮箱");
                alert.showAndWait();
            } else if (!StringUtils.isEmail(email)) {
                alert = new Alert(Alert.AlertType.ERROR, "无效邮箱地址");
                alert.showAndWait();
                emailText.setText("");
            } else {
                String msg = String.format("{\"event\": \"getEmailExists\", \"email\": \"%s\"}", email);
                JSONObject data = sendMessageToRegisterServer(msg);
                Boolean result = data.getBoolean("success");
                if (result) {
                    {
                        Boolean res = data.getBoolean("isExists");
                        if (!res) {
                            msg = String.format("{\"event\": \"sendCode\", \"email\": \"%s\"}", email);
                            data = sendMessageToRegisterServer(msg);
                            res = data.getBoolean("success");
                            if (res) {
                                sendCodeCount++;
                                endWaitSendCodeTime = new Date().getTime() + (1000 * 60);
                                alert = new Alert(Alert.AlertType.INFORMATION, "发送成功, 请稍后再试");
                                alert.showAndWait();
                            } else {
                                alert = new Alert(Alert.AlertType.INFORMATION, "无法发送验证码, 原因: " + data.getString("message"));
                                alert.showAndWait();
                                emailText.setText("");
                            }
                        } else {
                            alert = new Alert(Alert.AlertType.ERROR, "邮箱已被绑定, 请跟换邮箱");
                            alert.showAndWait();
                            emailText.setText("");
                        }
                    }
                } else {
                    String message = data.getString("message");
                    alert = new Alert(Alert.AlertType.ERROR, message);
                    alert.showAndWait();
                }
            }
        } else {
            int sec = (int) (endWaitSendCodeTime - new Date().getTime()) / 1000;
            alert = new Alert(Alert.AlertType.ERROR, "请" + sec + "秒后再试");
            alert.showAndWait();
        }
    }

    /**
     * 点击注册按钮的事件
     *
     * @throws IOException 抛出IOException异常
     */
    @FXML
    private void executeRegister() throws IOException {
        Alert alert;
        String msg;
        Boolean res;
        JSONObject data;
        String username = usernameText.getText();
        String password = passwordText.getText();
        String email = emailText.getText();
        String code = codeText.getText();
        if (username.equals("")) {
            alert = new Alert(Alert.AlertType.ERROR, "请输入用户名");
            alert.showAndWait();
        } else if (password.equals("")) {
            alert = new Alert(Alert.AlertType.ERROR, "请输入密码");
            alert.showAndWait();
        } else if (email.equals("")) {
            alert = new Alert(Alert.AlertType.ERROR, "请输入邮箱");
            alert.showAndWait();
        } else if (code.equals("")) {
            alert = new Alert(Alert.AlertType.ERROR, "请输入验证码");
            alert.showAndWait();
        } else {
            if (!StringUtils.isUsername(username)) {
                alert = new Alert(Alert.AlertType.ERROR, "用户名格式错误\n格式: 4~16位的字母与数字组合, 且开头不能为数字");
                alert.showAndWait();
                usernameText.setText("");
            } else if (!StringUtils.isPassword(password)) {
                alert = new Alert(Alert.AlertType.ERROR, "密码格式错误\n格式: 6~20位的数字与字母组合");
                alert.showAndWait();
                passwordText.setText("");
            } else if (!StringUtils.isEmail(email)) {
                alert = new Alert(Alert.AlertType.ERROR, "邮箱地址格式错误");
                alert.showAndWait();
                emailText.setText("");
            } else {
                msg = String.format("{\"event\": \"getUsernameExists\", \"username\": \"%s\"}", username);
                data = sendMessageToRegisterServer(msg);
                res = data.getBoolean("isExists");
                if (!res) {
                    msg = String.format("{\"event\": \"getEmailExists\", \"email\": \"%s\"}", email);
                    data = sendMessageToRegisterServer(msg);
                    res = data.getBoolean("isExists");
                    if (!res) {
                        if (sendCodeCount != 0) {
                            if (registerSuccessCount == 0) {
                                msg = String.format("{\"event\": \"verifyCode\", \"code\": \"%s\", \"email\": \"%s\"}", code, email);
                                data = sendMessageToRegisterServer(msg);
                                res = data.getBoolean("success");
                                if (res) {
                                    msg = String.format("{\"event\": \"requestsRegister\", \"username\": \"%s\", \"password\": \"%s\", \"email\": \"%s\"}", username, StringUtils.getStringSHA512(password), email);
                                    data = sendMessageToRegisterServer(msg);
                                    res = data.getBoolean("success");
                                    if (res) {
                                        alert = new Alert(Alert.AlertType.INFORMATION, data.getString("message"));
                                        alert.showAndWait();
                                    } else {
                                        alert = new Alert(Alert.AlertType.ERROR, "注册失败, 原因: " + data.getString("message"));
                                        alert.showAndWait();
                                    }
                                } else {
                                    alert = new Alert(Alert.AlertType.ERROR, data.getString("message"));
                                    alert.showAndWait();
                                    codeText.setText("");
                                }
                            } else {
                                alert = new Alert(Alert.AlertType.INFORMATION, "已注册成功");
                                alert.showAndWait();
                            }
                        } else {
                            alert = new Alert(Alert.AlertType.ERROR, "请先发送验证码");
                            alert.showAndWait();
                        }
                    } else {
                        alert = new Alert(Alert.AlertType.ERROR, "邮箱地址已存在");
                        alert.showAndWait();
                        usernameText.setText("");
                    }
                } else {
                    alert = new Alert(Alert.AlertType.ERROR, "用户名已存在");
                    alert.showAndWait();
                    usernameText.setText("");
                }
            }
        }
    }


}