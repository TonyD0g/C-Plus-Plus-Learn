# pair定义

```c++
template<class _T1, class _T2>
struct pair
{
    typedef _T1 first_type; 
    typedef _T2 second_type; 
    
    _T1 first; 
    _T2 second; 
    
    pair(): first(), second() { }
    
    pair(const _T1& __a, const _T2& __b): first(__a), second(__b) { }
    
    template<class _U1, class _U2>
    pair(const pair<_U1, _U2>& __p): first(__p.first), second(__p.second) { }
};
```

- pair实例化出来的对象都有两个成员变量：first, second

  

# make_pair定义

```c++
template <class T1, class T2>
pair<T1, T2> make_pair(T1 x, T2 y) {
    return pair<T1, T2>(x, y);
}
```



# 例子

```c++
#include <iostream>
using namespace std;

int main() {
    pair<int, double> p1;
    cout << p1.first << ", " <<p1.second << endl;

    pair<string, int> p2("this", 20);
    cout << p2.first << ", " <<p2.second << endl;

    pair<int, int> p3(pair<char, char>('a', 'b'));  // 用另外一个pair给当前pair初始化
    cout << p3.first << ", " <<p3.second << endl;

    pair<int, string> p4(make_pair(200, "hello"));
    cout << p4.first << ", " <<p4.second << endl;
    
    return 0;
}
```

```
0, 0
this, 20
97, 98
200, hello
```



