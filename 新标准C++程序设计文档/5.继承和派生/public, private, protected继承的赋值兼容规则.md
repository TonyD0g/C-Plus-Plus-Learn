# public派生的赋值兼容规则
  - 派生类的对象可以赋值给基类对象
    - b = d;
  - 派生类对象可以初始化基类引用
    - base & br = d;
  - 派生类对象的地址可以赋值给基类指针
    - base * pb = & d
```c++
#include <iostream>
using namespace std;

class Base { // 基类
public:
    int n1;
    Base(int n1_=0) : n1(n1_) {

    }
};

class Derived : public Base { // public派生类
public:
    int n2;
    Derived(int n1_=0, int n2_=0) : n2(n2_), Base(n1_) {

    }
};

int  main()
{
    Base b;
    Derived d(1, 2);

    b = d; // 基类将会slicing派生类
    cout << b.n1 << endl;

    Base &br = d;
    cout << br.n1 << endl;

    Base *pb = &d;
    cout << pb->n1 << endl;
    cout << pb->n2 << endl; // error: ‘class Base’ has no member named ‘n2’, 基类不能访问派生类的成员

    d.n1 = 2;
    cout << endl;
    cout << b.n1 << endl;
    cout << br.n1 << endl;
    cout << pb->n1 << endl;


    return 0;
}

```
输出：
```
1
1
1

1
2
2
```

# private, protected派生
  - protected继承时，基类的public成员和protected成员成为派生类的protected成员。
  - private继承时，基类的public成员成为派生类的private成员，基类的protected成员成为派生类的不可访问成员。
  - protected和private继承不是“是”的关系
  - 一般情况下都应使用public派生，不要使用private和protected派生

