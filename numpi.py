# 1. Importing NumPy
import numpy as np

# 2. Creating Arrays
arr_from_list = np.array([1, 2, 3])                  # From list
zeros_array = np.zeros((3, 3))                       # 3x3 array of zeros
ones_array = np.ones((2, 4))                         # 2x4 array of ones
empty_array = np.empty((2, 2))                       # 2x2 uninitialized array
range_array = np.arange(0, 10, 2)                    # [0, 2, 4, 6, 8]
linspace_array = np.linspace(0, 1, 5)                # [0. , 0.25, 0.5, 0.75, 1.]

# 3. Random Arrays
rand_array = np.random.rand(3, 3)                    # 3x3 random floats [0, 1]
randn_array = np.random.randn(3, 3)                  # 3x3 standard normal distribution
randint_array = np.random.randint(0, 10, (3, 3))     # 3x3 random integers [0, 10)

# 4. Array Properties
shape = rand_array.shape                             # Shape of the array
size = rand_array.size                               # Number of elements
dtype = rand_array.dtype                             # Data type
ndim = rand_array.ndim                               # Number of dimensions

# 5. Reshaping and Flattening
reshaped_array = rand_array.reshape((1, 9))          # Reshape to 1x9
flattened_array = rand_array.flatten()               # Flatten to 1D

# 6. Indexing and Slicing
element = arr_from_list[1]                           # Access element at index 1
slice_array = range_array[0:3]                       # Slice from index 0 to 2
column = randint_array[:, 1]                         # All rows of column 1
specific_element = randint_array[1, 1]               # Element at row 1, column 1
boolean_index = randint_array[randint_array > 5]     # Elements greater than 5
fancy_index = randint_array[[0, 2], [1, 2]]          # Select specific elements

# 7. Arithmetic Operations
added = range_array + 1                              # Add 1 to each element
subtracted = range_array - 2                         # Subtract 2 from each element
multiplied = range_array * 2                         # Multiply by 2
divided = range_array / 3                            # Divide by 3
sqrt_array = np.sqrt(range_array)                    # Square root

# 8. Element-wise Operations and Dot Product
elementwise_add = arr_from_list + arr_from_list      # Element-wise addition
elementwise_mul = arr_from_list * arr_from_list      # Element-wise multiplication
dot_product = np.dot(ones_array, zeros_array.T)      # Matrix multiplication

# 9. Aggregate Functions
total_sum = np.sum(rand_array)                       # Sum of elements
mean_val = np.mean(rand_array)                       # Mean value
std_dev = np.std(rand_array)                         # Standard deviation
min_val = np.min(rand_array)                         # Minimum value
max_val = np.max(rand_array)                         # Maximum value
argmin_idx = np.argmin(rand_array)                   # Index of minimum value
argmax_idx = np.argmax(rand_array)                   # Index of maximum value

# 10. Broadcasting
broadcast_add = rand_array + 5                       # Add 5 to each element
broadcast_array = rand_array + np.array([1, 2, 3])   # Add array [1, 2, 3] to rows

# 11. Transpose and Stacking
transposed = randint_array.T                         # Transpose of the array
vstacked = np.vstack((arr_from_list, arr_from_list)) # Vertical stack
hstacked = np.hstack((arr_from_list, arr_from_list)) # Horizontal stack

# 12. Splitting Arrays
split_arrays = np.split(range_array, 5)              # Split into 5 equal parts
hsplit_arrays = np.hsplit(rand_array, 3)             # Split horizontally into 3 parts
vsplit_arrays = np.vsplit(rand_array, 3)             # Split vertically into 3 parts

# 13. Copying Arrays
shallow_copy = arr_from_list.view()                  # Shallow copy (view)
deep_copy = arr_from_list.copy()                     # Deep copy

# 14. Conditional Operations
condition_where = np.where(rand_array > 0, 1, -1)    # Replace positive with 1, else -1
extracted_elements = np.extract(rand_array > 0, rand_array) # Extract elements > 0

# 15. Linear Algebra Operations
identity_matrix = np.eye(3)                          # 3x3 Identity matrix
matrix_inv = np.linalg.inv(identity_matrix)          # Inverse of matrix
matrix_det = np.linalg.det(identity_matrix)          # Determinant
eig_vals, eig_vecs = np.linalg.eig(identity_matrix)  # Eigenvalues and eigenvectors

# 16. Random Seed (for reproducibility)
np.random.seed(42)
fixed_random = np.random.rand(3, 3)                  # Same output every run

# 17. Saving and Loading Arrays
np.save('my_array.npy', arr_from_list)               # Save array to .npy file
loaded_array = np.load('my_array.npy')               # Load array from .npy file

# Print some results for quick verification
print("Original Array:", arr_from_list)
print("Reshaped Array:", reshaped_array)
print("Random Array:", fixed_random)
