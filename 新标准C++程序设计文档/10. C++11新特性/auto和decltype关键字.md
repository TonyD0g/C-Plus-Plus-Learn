# auto 

* 用于定义变量，编译起可以自动判断变量的类型

  ```
  auto i = 100 // i为整形int
  ```

  

# decltype

* 用于求表达式的类型

* 在c++11，若函数返回值为auto，则需要和decltype配合使用



```
#include <iostream>
#include <map>

using namespace std;

template <class T1, class T2>
auto Add(T1 a, T2 b) -> decltype(a + b) {
    return (a + b);
}

int main() {

    auto i = 100; // i是整形

    map<string, double, greater<string>> mp {make_pair("jerry", 9.9), make_pair("Tom", 8.3)};
    for (auto p=mp.begin(); p!=mp.end(); ++p) {  // p的类型会自动认为是map<string, double, greater<string>>::iterator
        cout << "("<< p->first << ", " << p->second << ")" << " ";
    }

    for (const auto& p: mp) { // p是mp中的每一个pair对象
        cout << "("<< p.first << ", " << p.second << ")" << " ";
    }


    return 0;
}
```



