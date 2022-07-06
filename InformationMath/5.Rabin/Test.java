package Test;

import java.math.BigInteger;
import java.util.Scanner;

public class Test {
    public static void main(String[] args) {
        System.out.println("Please input your want to encryption string:");
        Scanner input = new Scanner(System.in);
        String sn = input.nextLine();

        //明文
        BigInteger m = new BigInteger(sn);

        System.out.println("Please input the p:");
        BigInteger p = input.nextBigInteger();
        System.out.println("Please input the q:");
        BigInteger q = input.nextBigInteger();
        //算出n的值
        BigInteger n = p.multiply(q);

        //加密
        BigInteger f = m.pow(2);
        BigInteger c = f.mod(n);
        //得到密文
        String result = c.toString();
        System.out.println("The result is："+result);
    }
}

