# 容器适配器

* 容器适配器包括 stack, queue, priority_queue
* 容器适配器是没有迭代器的，因此STL中的各种排序，查找，变序等算法都不适用于容器适配器

#  stack

* stack是后进先出的数据结构，只能插入，删除，访问栈顶的元素
* 可用 vector, list, deque来实现。缺省情况下，用deque实现。用 vector和deque实现，比用list实现性能好
* 有3个成员函数：
  * push: 添加一个元素
  * top: 返回顶部的元素的引用　
  * pop: 删除一个元素
* stack类模板的定义

```c++
template<class T, class Cont = deque<T> > 
class stack { 
	…
}; 
```

```
#include <iostream>
#include<stack>

using namespace std;


int main() {
    stack<int, deque<int>> stk;
    cout << stk.size() << endl;

    stk.push(10);
    cout << stk.size() << endl;

    cout << stk.top() << endl;
    cout << stk.size() << endl;

    stk.push(3);
    cout << stk.top() << endl;
    cout << stk.size() << endl;

    stk.push(6);
    cout << stk.top() << endl;
    cout << stk.size() << endl;

    while (!stk.empty()) {
        cout << stk.top() << " ";  // 输出: 6 3 10, 后进先出
        stk.pop();
    }
    cout << endl;

    cout << stk.size() << endl; // 输出0


    return 0;
}
```



# queue

* queue先进先出
* 队头的访问和删除操作只能在队头，添加操作只能在队尾
* 不能访问中间的元素
* 和stack 基本类似，可以用 list和deque实现。缺省情况下用deque实现。
* queue类模板定义

```c++
template<class T, class Cont = deque<T> > 
class queue {
	……
};
```

* 成员函数：
  * push: 添加一个元素, 发生在队尾
  * front:  返回队头的元素的引用　
  * pop: 删除一个元素，发生在队头
  * back: 返回队尾元素的引用

```c++
#include <iostream>
#include<queue>

using namespace std;


int main() {
    queue<int, deque<int>> que;
    cout << que.size() << endl;

    que.push(10);
    cout << que.size() << endl;

    cout << que.front() << endl;
    cout << que.size() << endl;

    que.push(3);
    cout << que.front() << endl;
    cout << que.size() << endl;

    que.push(6);
    cout << que.front() << endl;
    cout << que.size() << endl;

    cout << "back: " << que.back() << endl; // 输出: "back: 6"

    while (!que.empty()) {
        cout << que.front() << " ";  // 输出: 10 3 6, 先进先出
        que.pop();
    }
    cout << endl;

    cout << que.size() << endl; // 输出0


    return 0;
}
```



# priority_queque

* 类模板定义

  ```c++
  template <class T, class Container = vector<T>, class Compare = less<T> > 
  class priority_queue {
  	...
  };
  ```

  * 和 queue类似，可以用vector和deque实现。缺省情况下用vector实现

* priority_queue 通常用堆排序技术实现，保证最大的元素总是在最前面。即执行pop操作时，删除的是最大的元素；执行top操作时，返回的是最大元素的常引用。默认的元素比较器是less<T>。

* priority_queue特别适用于：不停地在一堆元素中取走最大的元素

* priority_queue队头的元素只能被查看或者修改，不能被删除

  ```c++
  #include <iostream>
  #include<queue>
  
  using namespace std;
  
  
  int main() {
      // Test1, 以默认的less<T>来排序
      priority_queue<double, deque<double>> pq1;
      cout << pq1.top() << endl; // 输出：0
  
      pq1.push(0.2);
      pq1.push(2.2);
      pq1.push(3.2);
      pq1.push(1.2);
      cout << pq1.size() << endl; // 输出: 4
  
      while (!pq1.empty()) {
          cout << pq1.top() << " "; // 输出: 3.2 2.2 1.2 0.2, 队头总是最大的元素
          pq1.pop();
      }
      cout << endl;
  
      //Test2, 以默认的greater<T>来排序
      priority_queue<double, deque<double>, greater<double>> pq2; // 注：这里如果用vector<double>运行时会有问题
      cout << pq2.top() << endl; // 输出：0
  
      pq2.push(0.2);
      pq2.push(2.2);
      pq2.push(3.2);
      pq2.push(1.2);
      cout << pq2.size() << endl; // 输出: 4
  
      while (!pq2.empty()) {
          cout << pq2.top() << " "; // 输出: 0.2 1.2 2.2 3.2
          pq2.pop();
      }
  
      return 0;
  }
  ```

  

