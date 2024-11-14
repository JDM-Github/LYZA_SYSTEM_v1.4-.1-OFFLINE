# 1. Importing Matplotlib
import matplotlib.pyplot as plt
import numpy as np

# 2. Basic Plotting
x = np.linspace(0, 10, 100)         # X values (0 to 10 with 100 points)
y = np.sin(x)                       # Y values (sin of x)

plt.plot(x, y)                      # Line plot
plt.show()                          # Display the plot

# 3. Scatter Plot
y_noise = y + 0.2 * np.random.randn(100)
plt.scatter(x, y_noise, color='r')  # Scatter plot with red dots
plt.show()

# 4. Bar Plot
categories = ['A', 'B', 'C']
values = [10, 15, 7]
plt.bar(categories, values, color=['blue', 'orange', 'green'])  # Bar plot with colors
plt.show()

# 5. Histogram
data = np.random.randn(1000)
plt.hist(data, bins=30, color='purple', alpha=0.7)  # Histogram with 30 bins
plt.show()

# 6. Customizing Plots (Title, Labels, Grid)
plt.plot(x, y, label='sin(x)', color='blue', linestyle='--')
plt.title("Sine Wave")            # Set title
plt.xlabel("X Axis")              # Set X axis label
plt.ylabel("Y Axis")              # Set Y axis label
plt.grid(True)                    # Enable grid
plt.legend(loc='upper right')     # Display legend
plt.show()

# 7. Multiple Lines in One Plot
y2 = np.cos(x)
plt.plot(x, y, label='sin(x)')
plt.plot(x, y2, label='cos(x)', color='red')
plt.legend()
plt.show()

# 8. Subplots
fig, axs = plt.subplots(2, 1, figsize=(8, 6))   # 2 rows, 1 column subplots
axs[0].plot(x, y, color='green')                # First subplot
axs[0].set_title("Sine Wave")
axs[1].plot(x, y2, color='purple')              # Second subplot
axs[1].set_title("Cosine Wave")
plt.tight_layout()                              # Adjust spacing
plt.show()

# 9. Pie Chart
sizes = [20, 30, 25, 25]
labels = ['A', 'B', 'C', 'D']
plt.pie(sizes, labels=labels, autopct='%1.1f%%', colors=['#ff9999','#66b3ff','#99ff99','#ffcc99'])
plt.title("Pie Chart Example")
plt.show()

# 10. Error Bars
errors = 0.1 * np.abs(np.random.randn(len(x)))
plt.errorbar(x, y, yerr=errors, fmt='o', color='black', ecolor='red', elinewidth=1)
plt.title("Plot with Error Bars")
plt.show()

# 11. Stacked Bar Plot
values1 = [5, 7, 10]
values2 = [8, 6, 5]
plt.bar(categories, values1, label='Series 1')
plt.bar(categories, values2, bottom=values1, label='Series 2')
plt.legend()
plt.title("Stacked Bar Plot")
plt.show()

# 12. Saving Plots
plt.plot(x, y)
plt.title("Saved Plot Example")
plt.savefig('plot.png')            # Save as PNG
plt.savefig('plot.pdf')            # Save as PDF
plt.close()                        # Close the figure

# 13. Using Styles
plt.style.use('ggplot')            # Use 'ggplot' style
plt.plot(x, y)
plt.title("Styled Plot with ggplot")
plt.show()

# 14. Heatmap
matrix = np.random.rand(10, 10)    # 10x10 random matrix
plt.imshow(matrix, cmap='viridis')
plt.colorbar()                     # Show color bar
plt.title("Heatmap Example")
plt.show()

# 15. Annotations
plt.plot(x, y)
max_x = x[np.argmax(y)]
max_y = y.max()
plt.annotate('Max Point', xy=(max_x, max_y), xytext=(max_x+1, max_y),
             arrowprops=dict(facecolor='black', shrink=0.05))
plt.title("Plot with Annotation")
plt.show()

# 16. 3D Plotting
from mpl_toolkits.mplot3d import Axes3D

fig = plt.figure()
ax = fig.add_subplot(111, projection='3d')
z = np.linspace(0, 1, 100)
ax.plot(x, y, z, label='3D Line')
ax.set_xlabel('X Axis')
ax.set_ylabel('Y Axis')
ax.set_zlabel('Z Axis')
plt.title("3D Line Plot")
plt.show()

# 17. Histogram with Density Line
plt.hist(data, bins=30, density=True, alpha=0.6, color='g')  # Histogram
density_line = 1/(np.sqrt(2 * np.pi)) * np.exp(-0.5 * data**2)
plt.plot(np.sort(data), density_line, color='red')           # Density line
plt.title("Histogram with Density Line")
plt.show()

# 18. Interactive Mode (For Jupyter Notebooks)
# Uncomment in Jupyter to enable interactive mode
# %matplotlib inline
