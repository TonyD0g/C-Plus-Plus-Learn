# Vector基本概念

- 动态数组
- 元素在内存连续存放
- vector 上的常见操作复杂度（效率）如下：
  - 随机存取任何元素——常数 *O(1)*
  - 在末尾插入或移除元素具有较佳的性能——均摊常数 *O(1)*
  - 插入或移除元素——与到 vector 结尾的距离成线性 *O(n)*
- `vector`容器可以随机存取元素，也就是说支持`[]`运算符和`at`方式存取

# 构造函数

```c++
#include <iostream>
#include<vector>

using namespace std;

template <class T1, class T2>
void Print(T1 first, T2 last) {
    for(; first!=last; ++first) {
        cout << *first << " ";
    }
    cout << endl;
}

int main() {
    vector<int> v1(4, 9);
    Print(v1.begin(), v1.end());  // 9 9 9 9

    double a[5] = {1.2, 3.4, 5.6, 7.8};
    vector<double > v2(a, a+5);
    Print(v2.begin(), v2.end()); // 1.2 3.4 5.6 7.8 0

    vector<double > v3(v2.begin(), v2.begin()+3);
    Print(v3.begin(), v3.end()); // 1.2 3.4 5.6

    vector<double > v4(v3);
    Print(v4.begin(), v4.end()); // 1.2 3.4 5.6

    vector<string> v5{"one", "two", "three"};
    Print(v5.begin(), v5.end()); // one two three

    vector<int> v6;
    v6.push_back(1);
    v6.push_back(2);
    v6.push_back(3);
    Print(v6.begin(), v6.end()); // 1 2 3
    
    vector<int> v7 = {7, 5, 16, 8};
    Print(v7.begin(), v7.end()); // 7 5 16 8 
    
    return 0;
}
```

# vector逆向迭代器

- rbegin()
- rend()

```c++
#include <iostream>
#include<vector>

using namespace std;

template <class T1, class T2>
void Print(T1 first, T2 last) {
    for(; first!=last; ++first) {
        cout << *first << " ";
    }
    cout << endl;
}

int main() {
    vector<int> v = {7, 5, 16, 8};
    Print(v.rbegin(), v.rend()); // 8 16 5 7

    return 0;
}
```

# vector嵌套形成可变长的二维数组

```c++
#include <iostream>
#include<vector>

using namespace std;

int main() {
    vector<vector<int>> v(3); // 有3个元素,　每一个元素都是vector<int>的容器

    for (int i=0; i<v.size(); ++i) { // v[i]是一维数组
        for (int j=0; j<6; ++j) {    // v[i][j]也可当成是一维数组v[i]中的某个元素
            v[i].push_back(j);
        }
    }

    for (int i=0; i<v.size(); ++i) {
        for (int j=0; j<v[i].size(); ++j) {
            cout << v[i][j] << " ";
        }
        cout << endl;
    }

    return 0;
}
```

