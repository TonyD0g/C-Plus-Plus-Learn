# 二分查找的算法

* 有序区间算法要求所操作的区间是已经从小到大排好序的，而且需要随机访问迭代器的支持。所以有序区间算法不能用于关联容器和list
* 查找时的排序规则，必须和排序时的规则一致
* 等于"的含义： a 等于 b <=> "a必须在b前面"和"b必须在a前面"都不成立
* binary_search
* lower_bound
* upper_bound
* 有时需要在大量增加、删除数据的同时，还要进行大量数据的查找， 希望增加数据、删除数据、查找数据都能在 log(n)复杂度完成。排序+二分查找显然不可以，因加入新数据就要重新排序。可以使用“平衡二叉树”数据结构存放数据，体现在STL中，就是以下四种“排序容器” ：
  * multiset,  set,  multimap,  map
  * 如 multiset<int, greater<int> > st; //排序规则为从大到小

# binary_search 折半查找

* 要求容器已经有序且支持随机访问迭代器，返回是否找到， 时间复杂度O(log(n))

  ```c++
  template<class FwdIt, class T>
  bool binary_search(FwdIt first, FwdIt last, const T& val); 
  ```

  上面这个版本，比较两个元素x,y 大小时, 看 x < y

  ```c++
  template<class FwdIt, class T, class Pred> 
  bool binary_search(FwdIt first, FwdIt last, const T& val, Pred pr);
  ```

  上面这个版本，比较两个元素x,y 大小时, 若 pr(x,y) 为true，则认为x小于y

# lower_bound：

```c++
template<class FwdIt, class T> 
FwdIt lower_bound(FwdIt first, FwdIt last, const T& val);
```

* 要求[first,last)是有序的
* 查找[first,last)中的,最大的位置 FwdIt,使得[first,FwdIt) 中所有的元素都比 val 小

# upper_bound

```c++
template<class FwdIt, class T>
FwdIt upper_bound(FwdIt first, FwdIt last, const T& val); 
```

* 要求[first,last)是有序的
* 查找[first,last)中的,最小的位置 FwdIt,使得[FwdIt,last) 中所有的元素都比 val 大

# equal_range

```c++
template<class FwdIt, class T> 
pair<FwdIt, FwdIt> equal_range(FwdIt first, FwdIt last, const T& val); 
```

* 要求[first,last)是有序的，
* 返回值是一个pair, 假设为 p, 则：
  * [first,p.first) 中的元素都比 val 小，[p.second,last)中的所有元素都比 val 大
  * p.first 就是lower_bound的结果
  * p.last 就是 upper_bound的结果

# 综合例子

```c++
#include <iostream>
#include <algorithm>
#include <string>
#include <vector>
using namespace std;

struct Rule { // 若返回true,表明a1在a2前面; 否则, a1在a2后面
    bool operator()(const int& a1, const int& a2) const {
        return (a1%10 < a2%10);
    }
};

void Print(vector<int> &a) {
    for (auto it:a) {
        cout << it << " ";
    }
    cout << endl;
}

int main() {

    vector<int> a{14, 25, 42, 25, 17, 41, 13, 26};

    // 按从小到大排序
    sort(a.begin(), a.end());
    Print(a); // 13 14 17 25 25 26 41 42

    cout << binary_search(a.begin(), a.end(), 17) << endl; // 1

    auto p1 = lower_bound(a.begin(), a.end(), 25); // [13, 25), *p1=25
    cout << p1 - a.begin() << endl; // 3

    auto p2 = upper_bound(a.begin(), a.end(), 25); // [26, 42), *p2=26
    cout << p2 - a.begin() << endl; // 5

    auto p3 = equal_range(a.begin(), a.end(), 25); // (25, 26)
    cout << "("<< *p3.first << ", " << *p3.second << ")" << endl;
    

    // 按个位数从小到大排序
    sort(a.begin(), a.end(), Rule());
    Print(a);
    cout << binary_search(a.begin(), a.end(), 22, Rule()) << endl; // 1


    return 0;
}
```

