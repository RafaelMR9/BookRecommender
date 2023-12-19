import pandas as pd
import random

raw_df = pd.read_csv('./dataset/raw_dataset.csv')

raw_df = raw_df.drop(columns=['isbn13', 'subtitle', 'thumbnail', 'average_rating', 'num_pages', 'ratings_count'])

raw_df = raw_df.dropna()

raw_df['book_id'] = range(0, len(raw_df))



max_users = 2
min_rating = 1
max_rating = 5

user_ids = list(range(0, max_users))

user_book_associations = []

for user_id in user_ids:
    num_books = random.randint(10, 15)
    sampled_books = random.sample(range(len(raw_df)), num_books)
    for book_idx in sampled_books:
        rating = random.randint(min_rating, max_rating)
        book_info = raw_df.loc[book_idx, ['isbn10', 'title', 'authors', 'categories', 'description', 'published_year']].to_dict()
        user_book_associations.append({'user_id': user_id, 'book_id': raw_df.loc[book_idx, 'book_id'], 'rating': rating, **book_info})

df = pd.DataFrame(user_book_associations)

df.to_csv('./dataset/dataset.csv', index=False)