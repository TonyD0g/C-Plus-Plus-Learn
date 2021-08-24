# lambda表达式

实际上就是提供了一个类似**匿名函数**的特性，而匿名函数则是**在需要一个函数，但是又不想费力去命名一个函数的情况下**去使用的

```c++
[外部变量访问方式说明符](参数表) ->返回值类型 {
    语句
}
```

* [] 不使用任何外部变量
* [=] 以传值的形式使用所有外部变量
* [&] 以引用形式使用所有外部变量
* [x, &y] x 以传值形式使用，y 以引用形式使用
* [=,&x,&y] x,y 以引用形式使用，其余变量以传值形式使用
* [&,x,y] x,y 以传值的形式使用，其余变量以引用形式使用
* “->返回值类型”也可以没有， 没有则编译器自动判断返回值类型
* 使用auto关键字保存lambda函数, 下次就可以当做正常函数使用了

```c++
#include <iostream>
#include <algorithm>
#include <vector>
using namespace std;


int main() {
    // item1
    int x = 100, y = 200, z = 300;

    cout << [](double a, double b) { return a+b;} (1.2, 3.0) << endl; // 4.2

    auto ff = [=,&y,&z](int n) {
        cout << x << endl;
        ++y;
        ++z;
        return n*n;
    };

    ff(5); // 100
    cout << y << ", " << z << endl; // 201, 301

    // item2
    int a[]{2, 11, 46, 34, 3};
    sort(a, a+5, [](int a, int b){return a%10 < b%10;}); // 按个位小的排序
    for_each(a, a+5, [](int x){cout << x << " ";}); // 11 2 3 34 46
    cout << endl;

    // item3
    vector<int > v{3, 2, 1, 4};
    int total = 0;
    for_each(v.begin(), v.end(), [&](int &x){total += x; x *= 2;});
    cout << total << endl; // 10

    for_each(v.begin(), v.end(), [](int x){cout << x << " ";}); // 6 4 2 8
    cout << endl;

    return 0;
}
```

