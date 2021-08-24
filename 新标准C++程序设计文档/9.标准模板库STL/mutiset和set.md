- set和multiset都是关联容器，一般用平衡二叉树实现的
- set: 排序好的集合，不允许有相同的元素
- multiset: 排序好的集合，允许有相同的元素
- set和multiset中的find()和count()并不是用""运算符比较元素是否和待查找的值相等的，而是：
  - 如果"x比y小"和"y比x小"同时成立，就认为x和y相等



# multiset类模板定义

```c++
template<class Key, class Pred = less<Key>, class A = allocator<Key> >
class multiset {
   …… 
};
```

- key：第一个类型参数说明multiset每个元素都是Key类型

- Pred：用于说明容器排序的规则，一般是函数对象类，或是函数指针，内部在排序时定义了一个变量"Pred op", 根据表达式op(x, y)来比较两个元素的大小， Pred默认值是less<Key>:

  ```c++
  template <class Key>
  struct less {
       bool operator()(const Key &x, const Key &y) {
           return x < y;
       }
  };
  ```

- A：这个参数极少用到，一般都用默认值

```c++
#include <iostream>
#include<set>
using namespace std;

class A {
private:
    int n;
public:
    A(int n_) : n(n_) {

    }

    friend ostream &operator << (ostream & o, const A &a) {
        o << a.n;
        return o;
    }

    friend bool operator < (const A &a1, const A &a2) {
        return (a1.n < a2.n);
    }

    friend class Myless;

};

class Myless { // 对象函数
public:
    bool operator()(const A &a1, const A &a2) {
      return (a1.n % 10) < (a2.n % 10);
    }
};


template <class T>
void Print(T first, T last) {
    for (; first != last; ++first) {
        cout << *first << " ";
    }
}

int main() {
    multiset<int> a; //使用默认的less<int>
    int b[7] = {56, 23, 13, 67, 2, 45, 13};
    a.insert(b, b+sizeof(b)/sizeof(int));
    Print(a.begin(), a.end());  // 输出: 2 13 13 23 45 56 67
    cout << endl;

    multiset<A> m1;
    m1.insert(b, b+7);
    Print(m1.begin(), m1.end());  // 输出: 2 13 13 23 45 56 67
    cout << endl;

    multiset<A, Myless> m2;
    m2.insert(b, b+7);
    Print(m2.begin(), m2.end());  // 输出: 2 23 13 13 45 56 67
    cout << endl;

    m1.insert(22);
    Print(m1.begin(), m1.end());  // 输出: 2 13 13 22 23 45 56 67
    cout << endl;

    multiset<A>::iterator pp;

    pp = m1.find(22);
    if (pp!=m1.end()) {
        cout << "found: " << *pp << endl;  // 输出: found 22
    } else {
        cout << "Not found" << endl;
    }

    cout << m1.count(13) << endl; // 输出: 2

    pp = m1.lower_bound(13);
    cout << *pp << endl; // 输出：13

    pp = m1.upper_bound(13);
    cout << *pp << endl; // 输出：22

    m1.erase(m1.lower_bound(13), m1.upper_bound(13));
    Print(m1.begin(), m1.end());  // 输出: 2 22 23 45 56 67
    cout << endl;
    
    return 0;
}
```

```
class A {

}

multiset <A> a;  // 就等价于multiset<A, less<A>> a;

插入元素时，multiset会将被插入元素和已有元素进行比较。由于less模板是用 < 进行比较的，所以,这都要求 A 的对象能用 < 比较，即适当重载了 < 
```

# set模板类定义

```c++
template<class Key, class Pred = less<Key>, class A = allocator<Key> > 
class set { 
	… 
};
```

- 由于不能重复元素，所以set中插入某个元素的insert成员函数与multiset中的有所不同:

  ```c++
  pair<iterator, bool> insert(const T & val)	
  ```

* 关联容器的equal_range成员函数也是返回pair模板类对象 ：

  ```c++
  pair<iterator, iterator> equal_range(const T & val)	
  ```

  返回对象的first值就是lower_bound的值， second就是upper_bound的值

```c++
#include <iostream>
#include<set>
using namespace std;

template <class T>
void Print(T first, T last) {
    for (; first != last; ++first) {
        cout << *first << " ";
    }
}

int main() {
    int a[5] = {3, 4, 6, 1, 2};

    set<int> st(a, a+5);
    Print(st.begin(), st.end());  // 输出: 1 2 3 4 6
    cout << endl;

    set<int>::iterator pp;
    pair<set<int>::iterator, bool> result = st.insert(5);
    if (result.second) {
        cout << *result.first << " inserted" << endl;
    }

    if (st.insert(5).second) {
        cout << *result.first << " inserted" << endl;
    } else {
        cout << *result.first << " already exists" << endl;
    }

    pair<set<int>::iterator, set<int>::iterator> bound_result = st.equal_range(4);
    cout << *bound_result.first << ", " << *bound_result.second << endl;

    return 0;
}
```

