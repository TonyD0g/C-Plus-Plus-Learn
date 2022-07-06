def encryp(m, e, n):
    s = m % n
    for i in range(1, e):
        s = (s * (m % n)) % n
    print("密文:", s)



def decode(c, d, n):
    s = c % n
    for i in range(1, d):
        s = (s * (c % n)) % n
    print('明文:', s)



def judge(p, q, e):
    list = []
    list.append(p)
    list.append(q)
    list.append(e)
    for x in range(0, 3):
        if int(list[x]) > 1:
            # 查看因子
            for i in range(2, int(list[x])):
                if (int(list[x]) % i) == 0:
                    print(int(list[x]), "不是质数")
                    print(i, "乘于", int(list[x]) / i, "是", int(list[x]))
                    break
                else:
                    print(int(list[x]), "是质数")
                    break
        # 如果输入的数字小于或等于 1，不是质数
        else:
            print(int(list[x]), "不是质数")



if __name__ == '__main__':
    num = int(input('0：加密 ， 1:解密\n'))
    if num == 0:
        print('加密:      ')
        print('请输入P,Q,E,M(明文)')
        p = int(input('输入P:'))
        q = int(input('输入Q:'))
        e = int(input('输入E:'))
        judge(p, q, e)
        m = int(input('请输入M:'))
        encryp(m, e, p * q)

    else:
        print('解密:      ')
        print('请输入P,Q,E,C(密文)')
        p = int(input('输入P:'))
        q = int(input('输入Q:'))
        e = int(input('输入E:'))
        fi = (p - 1) * (q - 1)
        for i in range(fi):  # 求逆元d
            if e * i % fi == 1:
                d = i
                break
        judge(p, q, d)
        c = int(input('请输入C:'))
        decode(c, d, p * q)

