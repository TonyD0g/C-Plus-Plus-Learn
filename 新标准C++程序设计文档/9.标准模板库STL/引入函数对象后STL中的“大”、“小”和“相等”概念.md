# STL“大、“小”

* 默认情况下，STL中的容器和算法比较元素的大小是通过“<”运算符进行的

* 关联容器和STL中许多算法，都是可以自定义比较器的

* 在自定义了比较器op的情况下，以下三种说法是等价的：

  * x小于y
  *  op(x,y)返回值为true
  *  y大于x 

* 在自定义比较器op的情况下，"x和y相等"与“op(x, y)和op(y, x)都为假”是等价的

* op可以是函数对象 或函数指针

* 函数对象比较规则的注意事项

  ```
  struct 结构名
  {
  	bool operator()( const T & a1,const T & a2) {
  	//若a1应该在a2前面，则返回true。
  	//否则返回false。
  	}
  };
  
  // 排序规则返回true，意味着a1必须在a2前面
  // 返回 false，意味着a1并非必须在a2前面
  
  // 排序规则的写法，不能造成比较a1,a 返回true， 比较a2,a1也返回true，否则sort会runtime error
  // 比较a1,a2返回false比较a2,a1也返回false，则没有问题
  ```

  

  # STL中“相等”的概念

  * 有时，“x和y相等”等价于“x==y为真”

    * 例：在未排序的区间上进行的算法，如顺序查找find

  * 有时“x和y相等”等价于“x小于y和y小于x同时为假”

    * 例：有序区间算法，如binary_search, 关联容器自身的成员函数find

    ```c++
    #include <iostream>
    #include <algorithm>
    using namespace std;
    
    class A {
    private:
        int v;
    public:
        A(int n): v(n) {}
    
        bool operator < (const A &a2) const{
            cout << v << "<" << a2.v << "?" << endl;
            return false;
        }
    
        bool operator == (const A &a2) const{
            cout << v << "==" << a2.v << "?" << endl;
            return v == a2.v;
        }
    };
    
    int main() {
    
        A a[] = { A(1),A(2),A(3),A(4),A(5) };
    
        cout << binary_search(a, a+4, A(5));
    
        return 0;
    }
    
    输出：
    3<5?
    2<5?
    1<5?
    5<1?
    1
    ```

    