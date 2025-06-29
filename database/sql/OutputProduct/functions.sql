CREATE OR REPLACE FUNCTION update_products_residue_when_create_output_product()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE products
    SET residue = residue - NEW.quantity
    WHERE id = NEW.product_id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
